<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history".
 *
 * @property integer $id
 * @property integer $reference_id
 * @property integer $history_type
 * @property string $content
 * @property string $date
 *
 * @property MasterHistoryType $historyType
 * @property NotificationViewStatus[] $notificationViewStatuses
 */
class History extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reference_id', 'history_type'], 'integer'],
            [['content'], 'string'],
            [['date'], 'safe'],
            [['history_type'], 'exist', 'skipOnError' => true, 'targetClass' => MasterHistoryType::className(), 'targetAttribute' => ['history_type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reference_id' => 'Reference ID',
            'history_type' => 'History Type',
            'content' => 'Content',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHistoryType()
    {
        return $this->hasOne(MasterHistoryType::className(), ['id' => 'history_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationViewStatuses()
    {
        return $this->hasMany(NotificationViewStatus::className(), ['history_id' => 'id']);
    }
}
