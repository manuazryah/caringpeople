<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notification_view_status".
 *
 * @property integer $id
 * @property integer $reference_id
 * @property integer $history_id
 * @property integer $notifiaction_type_id
 * @property integer $staff_type
 * @property integer $staff_id_
 * @property string $content
 * @property string $date
 *
 * @property History $history
 */
class NotificationViewStatus extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'notification_view_status';
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['reference_id', 'history_id', 'notifiaction_type_id', 'staff_type', 'staff_id_'], 'integer'],
			[['content'], 'string'],
			[['date'], 'safe'],
			[['history_id'], 'exist', 'skipOnError' => true, 'targetClass' => History::className(), 'targetAttribute' => ['history_id' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'reference_id' => 'Reference ID',
		    'history_id' => 'History ID',
		    'notifiaction_type_id' => 'Notifiaction Type ID',
		    'staff_type' => 'Staff Type',
		    'staff_id_' => 'Staff ID',
		    'content' => 'Content',
		    'date' => 'Date',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getHistory() {
		return $this->hasOne(History::className(), ['id' => 'history_id']);
	}

	public function getStaffId() {
		return $this->hasOne(StaffInfo::className(), ['id' => 'staff_id_']);
	}

}
