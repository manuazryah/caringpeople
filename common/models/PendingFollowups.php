<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pending_followups".
 *
 * @property integer $id
 * @property integer $followup_id
 * @property string $assigned_to
 * @property integer $status
 * @property string $date
 */
class PendingFollowups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pending_followups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['followup_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['assigned_to'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'followup_id' => 'Followup ID',
            'assigned_to' => 'Assigned To',
            'status' => 'Status',
            'date' => 'Date',
        ];
    }
}
