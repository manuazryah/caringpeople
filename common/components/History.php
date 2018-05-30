<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SetValues
 *
 * @author user
 */

namespace common\components;

use Yii;
use yii\base\Component;

class History extends Component {

        public function UpdateHistory($type, $type_id, $action, $data = NULL) {
                $model_history = new \common\models\History();
                $model_history->type = $type;
                $model_history->type_id = $type_id;
                $model_history->action = $action;
                $model_history->user_id = Yii::$app->user->identity->id;
                $model_history->data = $data;
                $model_history->date = date('Y-m-d H:i:s');
                $model_history->save();
                return TRUE;
        }

}
