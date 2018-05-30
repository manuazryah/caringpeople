<?php

//

namespace common\components;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use common\models\Remarks;
use common\models\RemarksSearch;

class RemarksWidget extends Widget {

        public $model;
        public $type_id;
        public $type;
        public $form_remark;
        public $searchModel;
        public $dataProvider;

        public function init() {
                parent::init();
        }

        public function run() {
                $remarks = new Remarks();
                $searchModel = new RemarksSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type_id' => $this->type_id, 'type' => $this->type]);

                if (!empty(Yii::$app->request->queryParams['RemarksSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['RemarksSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 2]);
                }



                return $this->render('_remarks_form', ['type_id' => $this->type_id, 'type' => $this->type, 'remark' => $remarks, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
        }

}

?>