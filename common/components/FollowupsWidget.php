<?php

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\FollowupsSearch;

class FollowupsWidget extends Widget {

        public $model;
        public $type_id;
        public $type;
        public $form_followup;
        public $searchModel;
        public $dataProvider;

        public function init() {
                parent::init();
        }

        public function run() {

                $followups = new \common\models\RepeatedFollowups();
                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type_id' => $this->type_id, 'type' => $this->type]);

                if (!empty(Yii::$app->request->queryParams['FollowupsSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['FollowupsSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 1]);
                }
                return $this->render('_followup_form', ['type_id' => $this->type_id, 'type' => $this->type, 'model' => $followups, 'form_followup' => $this->form_followup, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        }

}

?>