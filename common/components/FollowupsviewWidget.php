<?php

namespace common\components;

use yii\base\Widget;
use yii\helpers\Html;

class FollowupsviewWidget extends Widget {

        public $model;
        public $data;
        public $followup_id;
        public $type;
        public $type_id;
        public $sub_type;
        public $followup_date;
        public $followup_notes;
        public $assigned_to;
        public $assigned_from;

        public function init() {
                parent::init();
        }

        public function run() {

                return $this->render('_followup_view', [
                            //      'data' => $this->value, 'followup_id' => $this->value->id, 'type' => $this->value->type, 'type_id' => $this->value->type_id, 'sub_type' => $this->value->sub_type, 'followup_date' => $this->value->followup_date, 'followup_notes' => $this->value->followup_notes, 'assigned_to' => $this->value->assigned_to, 'assigned_from' => $this->value->assigned_from, 'status' => $this->value->status
                            'data' => $this->data,
                ]);
        }

}

?>