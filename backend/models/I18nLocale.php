<?php

namespace app\models;

use Yii;
use app\components\ActiveRecord;

/**
 * This is the model class for table "i18n_locale".
 *
 * @property int $id
 * @property string $code
 * @property string $locale
 * @property string $name
 * @property int $status
 *
 * @property I18nMessage[] $i18nMessages
 * @property I18nSourceMessage[] $sourceMessages
 */
class I18nLocale extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'i18n_locale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'locale', 'name'], 'required'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 2],
            [['locale'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 30],
            [['locale'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'locale' => 'Locale',
            'name' => 'Name',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[I18nMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getI18nMessages()
    {
        return $this->hasMany(I18nMessage::className(), ['locale_id' => 'id']);
    }

    /**
     * Gets query for [[SourceMessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessages()
    {
        return $this->hasMany(I18nSourceMessage::className(), ['id' => 'source_message_id'])->viaTable('i18n_message', ['locale_id' => 'id']);
    }

    public static function getList($includeCurrentLocale = false, $islink = false)
    {
        $where = ['status' => 1];
        if (!$includeCurrentLocale) {
            $where[] = ['<>', 'locale', Yii::$app->language];
        }

        $list = static::getListAss($where, ['locale', 'code', 'name'], 'code', false);
        $result = [];
        foreach ($list as $value) {
            $result[$value['locale']] = strtoupper($value['code']).' - '.$value['name'];
            // Html::a(
            //     strtoupper($value['code']).' - '.$value['name'],
            //     ['guest/locale', 'locale' => $value['locale']]
            // );
        }
        return $result;
    }
}
