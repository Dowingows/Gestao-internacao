<?php

namespace app\controllers;

use app\models\Internment;
use app\models\InternmentProcedure;
use app\models\InternmentSearch;
use Exception;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InternmentController implements the CRUD actions for Internment model.
 */
class InternmentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Internment models.
     *
     * @return string
     */
    public function actionIndex()
    {   
        $searchModel = new InternmentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Internment model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Internment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Internment();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $internmentProcedure = \app\models\Model::createMultiple(\app\models\InternmentProcedure::class);
                \app\models\Model::loadMultiple($internmentProcedure, $this->request->post());
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($internmentProcedure as $procedureData) {

                            $procedureData->internment_id = $model->id;
                            if (!($flag = $procedureData->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                       $transaction->commit();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Internment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateExtension($id)
    {
        $parent = $this->findModel($id);
    
        $model = new Internment();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $internmentProcedure = \app\models\Model::createMultiple(\app\models\InternmentProcedure::class);
                \app\models\Model::loadMultiple($internmentProcedure, $this->request->post());
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $model->save(false)) {
                        foreach ($internmentProcedure as $procedureData) {

                            $procedureData->internment_id = $model->id;
                            if (!($flag = $procedureData->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                       $transaction->commit();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create_extension', [
            'model' => $model,
            'parent' => $parent
        ]);
    }

    /**
     * Updates an existing Internment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if(!empty($model->deleted_at)){
            return $this->redirect(['index']);
        }

        $internmentProcedure = $model->internmentProcedure;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $internmentProcedure = \app\models\Model::createMultiple(InternmentProcedure::class, $internmentProcedure);
            \app\models\Model::loadMultiple($internmentProcedure, $this->request->post());


            $transaction = \Yii::$app->db->beginTransaction();
            InternmentProcedure::deleteAll(['internment_id' => $model->id]);
            try {
                if ($flag = $model->save(false)) {
                    foreach ($internmentProcedure as $procedureData) {
                        $procedureData->internment_id = $model->id;
                        if (!($flag = $procedureData->save(false))) {
                            $transaction->rollBack();
                            break;
                        }
                    }
                }
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Internment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_at =  new \yii\db\Expression('NOW()');
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Internment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Internment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Internment::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
