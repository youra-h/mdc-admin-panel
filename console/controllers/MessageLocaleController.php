<?php
namespace console\controllers;

use Yii;
use yii\db\Connection;
use yii\db\Query;
use yii\helpers\Console;

class MessageLocaleController extends \yii\console\controllers\MessageController
{        
    public string $devide = '/';

    /**
     * очищает табицы db
     * @param string $categoryTable
     * @param string $localeTable
     * @param string $messageTable
     * @param string $sourceMessageTable
     */
    private function clearTableI18n(
        string $categoryTable = '',
        string $localeTable = '',
        string $messageTable = '',
        string $sourceMessageTable = ''        
    ): void
    {
        function getsql($tableName, $autoIncrementNole = true): string 
        {
            $result = '';
            if (!empty($tableName)) {
                $tableName = str_replace('{{%', '', $tableName);
                $tableName = str_replace('}}', '', $tableName);
                $result = "DELETE FROM $tableName;";
                if ($autoIncrementNole) {
                    $result .= "ALTER TABLE $tableName AUTO_INCREMENT = 1;";
                }
            }
            return $result;
        }

        $this->stdout("Clear langauges tables...\n\n");

        $sql = getsql($localeTable, $this);
        $sql .= getsql($messageTable, $this, false);
        $sql .= getsql($sourceMessageTable, $this);
        $sql .= getsql($categoryTable, $this);

        if (!empty($sql)) {
            Yii::$app->db->createCommand($sql)->execute();
        }
    }

    //Вернуть все сообщения из db table - $sourceMessageTable
    private function getMessagesFromDb(string $sourceMessageTable): array
    {
        $messages = [];
        $rows = (new Query())->select(['id', 'category', 'message'])
            ->from($sourceMessageTable)
            ->where(['status' => 1])
            ->all($db);
        foreach ($rows as $row) {
            $messages[$row['category']][$row['id']] = $row['message'];
        }
        return $messages;
    }

    //Вернуть категории вида 'backend/main/menu' из db table - $categoryTable
    private function getCategoryDb(string $categoryTable): array
    {
        return (new Query())
            ->select(['id', 'name', 'parent_id', 'status' => new \yii\db\Expression(0), 'status as status_db'])
            ->from($categoryTable)
            ->all();        
    }

    /**
     * Saves messages to database
     *
     * @param array $messages  Это двухмерный массив ключей [[категори]=>[[значение],[...]] ,... ]
     * @param \yii\db\Connection $db
     * @param string $sourceMessageTable Таблица начальных сообщений
     * @param string $messageTable  Переводы
     * @param boolean $removeUnused
     * @param array $languages  Это массив языков languages из i18n.php ['ru-RU',...]
     * @param boolean $markUnused
     */
    protected function saveMessagesToDb($messages,
        $db,
        $sourceMessageTable,
        $messageTable,
        $removeUnused,
        $languages,
        $markUnused) 
    {
        $localeTable = isset($this->config['localeTable']) ? $this->config['localeTable'] : '{{%locale}}';
        $categoryTable = isset($this->config['categoryTable']) ? $this->config['categoryTable'] : '{{%category}}';

        //Загрузить все мессаджи из source
        $currentMessages = $this->getMessagesFromDb($sourceMessageTable);

        //Загрузить все locale формата ru_Ru
        $currentLocaleDb = [];
        $rows = (new Query())->select(['id', 'locale'])->from($localeTable)->all($db);
        foreach ($rows as $row) {
            $currentLocaleDb[$row['id']] = $row['locale'];
        }

        //Загрузить список locale из i18n.php
        // 'locale' => 'ru_RU','name' => 'Русский'
        $localeConfig = [];
        foreach ($languages as $key => $list) {
            if (isset($list['locale'])) {
                $localeConfig[] = array_merge(['code' => $key], $list);
            } else {
                foreach ($list as $key1 => $newlist) {
                    $localeConfig[] = array_merge(['code' => $key], $newlist);
                }
            }
        }

        $newLocale = false;
        //Добавить locale в Db и вернуть массив LocaleConfig с готовыми id
        foreach ($localeConfig as $key => $locale) {
            if ($id = array_search($locale['locale'], $currentLocaleDb)) {
                $localeConfig[$key]['id'] = $id;
            } else {
                $lastPk = $db->schema->insert($localeTable, [
                    'code' => $locale['code'],
                    'locale' => $locale['locale'],
                    'name' => $locale['name'],
                ]);
                $localeConfig[$key]['id'] = $lastPk['id'];
                $localeConfig[$key]['new'] = true;
                $newLocale = true;
                $this->stdout("Insertins new locale - " . $locale['locale'] . ", " . $locale['name'] . "\n");
            }
        }

        $this->stdout("\n");

        $new = [];
        $obsolete = [];

        /**
         * Сравние с текущими сообщениями с сайта и бд
         * Если сообщение из БД не найдено в currentMessages, оно помечается как устаревшее status = 0
         * Сообщения которые не были найдены в БД загружаются в new
         */
        foreach ($messages as $category => $msgs) {
            $msgs = array_unique($msgs);

            if (isset($currentMessages[$category])) {
                $new[$category] = array_diff($msgs, $currentMessages[$category]);
                $obsolete += array_diff($currentMessages[$category], $msgs);
            } else {
                $new[$category] = $msgs;
            }
        }        

        $countMessage = 0;
        foreach ($new as $category => $msgs) {
            $countMessage += count($msgs);
        }
        if ($countMessage > 0) {
            $this->stdout("Inserting new messages (and add new translations) - $countMessage...\n");
            //Добавить новые сообщения в таблицу source_message
            //В таблицу message записи будут добавлены только по старым locale из db
            //Это нужно, чтобы не было дублирования записей
            //По новым locale записи будут добавлены отдельно
            foreach ($new as $category => $msgs) {
                foreach ($msgs as $msg) {
                    //Вернуть последний Id
                    $lastPk = $db->schema->insert($sourceMessageTable,
                        ['category' => $category, 'message' => $msg]
                    );
                    foreach ($localeConfig as $locale) {
                        if (!isset($locale['new'])) {
                            $db->createCommand()
                                ->insert($messageTable,
                                    ['source_message_id' => $lastPk['id'], 'locale_id' => $locale['id']]
                                )
                                ->execute();
                        }
                    }
                }

                $this->stdout("--" . $category . " - added " . count($msgs) . " message\n");
            }
            $this->stdout("\n");
        }

        //Похожие сообщения сравнить по категориям
        foreach (array_diff(array_keys($currentMessages), array_keys($messages)) as $category) {
            $obsolete += $currentMessages[$category];
        }

        //Установить статус для сообщений = 0 если они больше не используются на сайте
        $obsolete = array_keys($obsolete);

        if (!empty($obsolete)) {
            $this->stdout("Removed " . count($obsolete) . " messages...\n\n");
            $db->createCommand()
                ->update($sourceMessageTable, ['status' => 0], ['id' => $obsolete])
                ->execute();
        }

        //Добавить в таблицу message по новым locale
        if ($newLocale) {
            $count = 0;
            $this->stdout("Insert translations for new locale... \n");
            $currentMessages = $this->getMessagesFromDb($sourceMessageTable);
            foreach ($currentMessages as $category => $msgs) {
                foreach ($msgs as $id => $msg) {
                    foreach ($localeConfig as $locale) {
                        if (isset($locale['new'])) {
                            $count++;
                            $db->createCommand()
                                ->insert($messageTable,
                                    ['source_message_id' => $id, 'locale_id' => $locale['id']]
                                )
                                ->execute();
                        }
                    }
                }
            }
            $this->stdout("--Loaded $count new translations\n\n");
        }

        /**
         * Поиск нужной категории по массиву категорий загруженных из db
         * @param array $categoryDb 
         * @param string $searchCategory - искомое значение из категории 
         * @param int | null $parentId - ссылка
         */
        function findCategoryDb(array &$categoryDb, string $searchCategory, &$parentId): bool 
        {            
            foreach ($categoryDb as $index => $cItem) {
                if ($cItem['name'] == $searchCategory && $cItem['parent_id'] == $parentId) {
                    $categoryDb[$index]['status'] = 1;                    
                    $parentId = $cItem['id'];
                    return true;
                } else {
                    if ($categoryDb[$index]['status'] !== 1) {
                        $categoryDb[$index]['status'] = 0;
                    }
                }
            }

            return false;
        }

        /**
         * Добавить новые категории
         * @param array $category - категория вида ['backend', 'main']
         * @param int $lenel - уровень с которого добавить категории
         * @param int | null $parentId - начальный Id предыдущего значения из катеогрии или null
         * @param array $categoryDb - катеогрии загруженные из db
         * @param {} $db
         * @param MessageLocaleController $this
         */
        function insertCategory(array $category, int $level, $parentId, array &$categoryDb, $db, MessageLocaleController $th, string $categoryTable): void 
        {            
            for ($i = $level; $i < count($category); $i++) { 
                $lastPk = $db
                    ->schema
                    ->insert($categoryTable,
                        ['name' => $category[$i], 'parent_id' => $parentId]
                    );
                $categoryDb[] = [
                    'id' => $lastPk['id'],
                    'name' => $category[$i],
                    'parent_id' => $parentId,
                    'status' => 1,
                    'status_db' => 1
                ];
                $parentId = $lastPk['id'];   
                $th->stdout("---- ".$category[$i]."\n");             
            }
        }        

        $categoryDb = $this->getCategoryDb($categoryTable);
        
        //Добавляем новые категории в таблицу категорий        
        $this->stdout("Update category...\n"); 
        foreach ($messages as $category => $value) {
            $list = explode($this->devide, $category);            
            $parentId = null;                       
            foreach ($list as $index => $item) {                
                if (findCategoryDb($categoryDb, $item, $parentId) === false) {
                    $this->stdout("-- $category\n");                    
                    insertCategory($list, $index, $parentId, $categoryDb, $db, $this, $categoryTable);
                    break;
                }
            }            
        }
        $this->stdout("\n");
        
        //Обновление категорий прекративших свое существование
        foreach ($categoryDb as $item) {
            if ($item['status'] != $item['status_db']) {
                $this->stdout("update category ".$item['name']."\n");
                $this->stdout("-- status = ".$item['status']."\n");
                $db->createCommand()
                    ->update($categoryTable, ['status' => $item['status']], ['id' => $item['id']])
                    ->execute();
            }
        }
    }
}
