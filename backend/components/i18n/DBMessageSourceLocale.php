<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\components\i18n;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\i18n\DbMessageSource;

class DbMessageSourceLocale extends DbMessageSource
{
    public $sourceMessageTable = '{{%i18n_source_message}}';
    public $messageTable = '{{%i18n_message}}';
    public string $localeTable = '{{%i18n_locale}}';
    public string $categoryTable = '{{%i18n_category}}';    

    protected function loadMessagesFromDb($category, $language)
    {
        $messages = (new Query())
                        ->select(['message' => 'ism.message', 'translation' => 'im.translation'])
                        ->from(['ism' => $this->sourceMessageTable])
                        ->leftJoin(['im' => $this->messageTable], 'ism.id = im.source_message_id')
                        ->innerJoin(['il' => $this->localeTable], 'im.locale_id = il.id')
                        ->where([
                            'ism.category' => $category,
                            'ism.status' => 1,
                            'il.locale' => $language,
                            'il.status' => 1
                        ])
                        ->all();
                                
        return ArrayHelper::map($messages, 'message', 'translation');
    }
}