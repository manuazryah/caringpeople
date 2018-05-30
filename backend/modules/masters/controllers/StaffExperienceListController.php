<?php

namespace backend\modules\masters\controllers;

use Yii;
use common\models\StaffExperienceList;
use common\models\StaffExperienceListSearch;
use common\models\SkillsCategory;
use common\models\SkillsCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\AssessmentCategory;
use common\models\AssessmentCategorySearch;

/**
 * StaffExperienceListController implements the CRUD actions for StaffExperienceList model.
 */
class StaffExperienceListController extends Controller {

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
         * Lists all StaffExperienceList models.
         * @return mixed
         */
        public function actionIndex() {
                $searchModel = new StaffExperienceListSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['status' => 1]);
                $model = new StaffExperienceList();

                $searchModel1 = new AssessmentCategorySearch();
                $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                $dataProvider1->query->andWhere(['status' => 1]);
                $category = new AssessmentCategory();


                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                } else if ($category->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($category) && $category->validate() && $category->save()) {
                        return $this->redirect(['index']);
                }


                return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model' => $model,
                            'category' => $category,
                            'searchModel1' => $searchModel1,
                            'dataProvider1' => $dataProvider1,
                ]);
        }

        /**
         * Displays a single StaffExperienceList model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id) {
                return $this->render('view', [
                            'model' => $this->findModel($id),
                ]);
        }

        /**
         * Creates a new StaffExperienceList model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate() {
                $model = new StaffExperienceList();
                $searchModel1 = new SkillsCategorySearch();
                $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);

                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('create', [
                                    'model' => $model,
                        ]);
                }
        }

        /**
         * Updates an existing StaffExperienceList model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         */
        public function actionUpdate($id) {
                $model = $this->findModel($id);

                $searchModel = new StaffExperienceListSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere(['status' => 1]);


                $searchModel1 = new AssessmentCategorySearch();
                $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                $dataProvider1->query->andWhere(['status' => 1]);
                $category = new AssessmentCategory();


                if ($model->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($model) && $model->validate() && $model->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('index', [
                                    'searchModel' => $searchModel,
                                    'dataProvider' => $dataProvider,
                                    'model' => $model,
                                    'category' => $category,
                                    'searchModel1' => $searchModel1,
                                    'dataProvider1' => $dataProvider1,
                        ]);
                }
        }

        public function actionCategory($id) {
                $category = AssessmentCategory::findOne($id);
                $searchModel = new StaffExperienceListSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $searchModel1 = new AssessmentCategorySearch();
                $dataProvider1 = $searchModel1->search(Yii::$app->request->queryParams);
                $model = new StaffExperienceList();
                if ($category->load(Yii::$app->request->post()) && Yii::$app->SetValues->Attributes($category) && $category->validate() && $category->save()) {
                        return $this->redirect(['index']);
                } else {
                        return $this->render('index', [
                                    'searchModel' => $searchModel,
                                    'dataProvider' => $dataProvider,
                                    'category' => $category,
                                    'model' => $model,
                                    'searchModel1' => $searchModel1,
                                    'dataProvider1' => $dataProvider1,
                        ]);
                }
        }

        /**
         * Deletes an existing StaffExperienceList model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id) {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
        }

        public function actionCategorydelete($id) {
                $cat = AssessmentCategory::findOne($id);
                $cat->delete();
                return $this->redirect(['index']);
        }

        /**
         * Finds the StaffExperienceList model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return StaffExperienceList the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
                if (($model = StaffExperienceList::findOne($id)) !== null) {
                        return $model;
                } else {
                        throw new NotFoundHttpException('The requested page does not exist.');
                }
        }

}
