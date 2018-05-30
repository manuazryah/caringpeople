<?php

namespace backend\modules\followup\controllers;

use Yii;
use common\models\Followups;
use common\models\FollowupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use common\models\RepeatedFollowups;

/**
 * FollowupsController implements the CRUD actions for Followups model.
 */
class FollowupsController extends Controller {


        public function beforeAction($action) {
                if (!parent::beforeAction($action)) {
                        return false;
                }
                if (Yii::$app->user->isGuest) {
                        $this->redirect(['/site/index']);
                        return false;
                }
                return true;
        }

        /**
         * @inheritdoc
         */
        public function behaviors() {
                return [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ];
        }

        /**
         * Lists all Followups models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['assigned_to' => Yii::$app->user->identity->id]);
                if (!empty(Yii::$app->request->queryParams['FollowupsSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['FollowupsSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 1]);
                }
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        /*
         * to view followups that you are in related staffa
         */

        public function actionViewrelated() {
                $searchModel = new FollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(new Expression('FIND_IN_SET(:related_staffs, related_staffs)'))->addParams([':related_staffs' => Yii::$app->user->identity->id]);
                if (!empty(Yii::$app->request->queryParams['FollowupsSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['FollowupsSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 1]);
                }
                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionRepeated($typeid, $type) {
                $searchModel = new \common\models\RepeatedFollowupsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['type_id' => $typeid, 'type' => $type]);
                if (!empty(Yii::$app->request->queryParams['RepeatedFollowupsSearch']['status'])) {
                        $dataProvider->query->andWhere(['status' => Yii::$app->request->queryParams['RepeatedFollowupsSearch']['status']]);
                } else {
                        $dataProvider->query->andWhere(['<>', 'status', 1]);
                }
                return $this->render('repeated', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                ]);
        }

        public function actionFollowups() {

                $type_id = '';
                $type = '';
                return $this->render('_followp_form', ['type_id' => $type_id, 'type' => $type]);
        }

        protected function findModel($id) {
                if (($model = Followups::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

        public function actionFollowupscron() {

                $today_date_time = date('Y-m-d H:i:s');
                $today = date("Y-m-d");
                $today_day = date("l");
                $today_date = date("j");

                /*
                 * Ever Day
                 */

                $today_followup = RepeatedFollowups::find()->where(['repeated_type' => 4])->all();
                foreach ($today_followup as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * Specific days in a week
                 */
                $followup_days = RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_day])->all();
                foreach ($followup_days as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }

                /*
                 * specific dates in amonth
                 */
                $followup_dates = RepeatedFollowups::find()->where(new Expression('FIND_IN_SET(:repeated_days, repeated_days)'))->addParams([':repeated_days' => $today_date])->all();
                foreach ($followup_dates as $value) {
                        $followup = new Followups();
                        Yii::$app->Followups->Addcronfollowup($followup, $value);
                }
        }

}
