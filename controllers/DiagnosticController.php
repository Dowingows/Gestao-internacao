<?php

namespace app\controllers;

use app\models\Diagnostic;
use app\models\DiagnosticProcedure;
use app\models\DiagnosticSearch;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * DiagnosticController implements the CRUD actions for Diagnostic model.
 */
class DiagnosticController extends Controller
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
     * Lists all Diagnostic models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DiagnosticSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Diagnostic model.
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
     * Creates a new Diagnostic model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Diagnostic();
        
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $diagnosticProcedure = \app\models\Model::createMultiple(\app\models\DiagnosticProcedure::class);
                \app\models\Model::loadMultiple($diagnosticProcedure, $this->request->post());
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($diagnosticProcedure as $procedureData) {
                           
                            $procedureData->diagnostic_id = $model->id;
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
     * Updates an existing Diagnostic model.
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

        $diagnosticProcedure = $model->diagnosticProcedure;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            
            
            $diagnosticProcedure = \app\models\Model::createMultiple(DiagnosticProcedure::class, $diagnosticProcedure);
            \app\models\Model::loadMultiple($diagnosticProcedure, $this->request->post());
            

            $transaction = \Yii::$app->db->beginTransaction();
            DiagnosticProcedure::deleteAll(['diagnostic_id' => $model->id]);
            try {
                if ($flag = $model->save(false)) {
                    foreach ($diagnosticProcedure as $procedureData) {
                        $procedureData->diagnostic_id = $model->id;
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
     * Deletes an existing Diagnostic model.
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
     * Finds the Diagnostic model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Diagnostic the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Diagnostic::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
