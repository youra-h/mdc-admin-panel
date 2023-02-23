<?php 

namespace app\components;

use yii\helpers\ArrayHelper;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * Ассоциативный список [id => name]
     * @param array $where - условия поиска
     * @param array $fields
     * @param string $order
     * @param bool $map - выведет ассоциативный массив $id => $name
     */
    public static function getListAss(
        array $where = [], 
        array $fields = ['id' => 'id', 'name' => 'name'], 
        string $order = 'name',
        bool $ass = false): array
    {
        $list = static::find()
                    ->select($fields);
        //Для сложных условий
        foreach ($where as $value) {
            $list->andWhere($value);
        } 
        $list = $list
                    ->orderBy($order)
                    ->asArray()
                    ->all();
        if ($ass) {            
            return ArrayHelper::map($list, $fields['id'], $fields['name']);
        } else {
            return $list;
        }
    }
}