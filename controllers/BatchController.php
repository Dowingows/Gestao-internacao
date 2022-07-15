<?php

namespace app\controllers;

use Yii;
use app\models\Batch;
use app\models\BatchSearch;
use app\models\Diagnostic;
use app\models\Internment;
use app\models\InternmentAllSearch;
use app\models\DiagnosticAllSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BatchController implements the CRUD actions for Batch model.
 */
class BatchController extends Controller
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
     * Lists all Batch models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BatchSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Batch model.
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
     * Creates a new Lote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateInternment()
    {
        $showForm = false;

        $model = new Batch();

        $searchModel = new InternmentAllSearch();
        
        if (empty($this->request->queryParams['InternmentAllSearch'])) {
            $internments = $searchModel->search([]);
        } else {
            $showForm = true;
            $internments =  $searchModel->search($this->request->queryParams['InternmentAllSearch']);
        }
  
        $answers = [];

        if (!empty($this->request->post())) {
            $batch = $this->generateLote($this->request->post());
            if (!empty($batch)) {
                return $this->redirect(['view', 'id' => $batch->id]);
            } else {

                $error_message = "Erro ao gerar lote! Tente novamente";
                return $this->render('create-internment', [
                    'model' => $model,
                    'internments' => $internments,
                    'answers' => $answers ,
                    'search' => $searchModel,
                    'showForm' => $showForm,
                    'error_message' => $error_message
                ]);
            }
        } else {
            return $this->render('create-internment', [
                'model' => $model,
                'internments' => $internments,
                'answers' => $answers ,
                'search' => $searchModel,
                'showForm' => $showForm
            ]);
        }
    }

    protected function generateLote($answers)
    {
        /*Only create a new Lote if there is at least one liked internacao */

        $transaction = Yii::$app->db->beginTransaction();

     
        try {
            $atLeastOne = false;
            $batch = new Batch();

            $batch->load(['Lote']);
            if ($batch->save()) {
                foreach ($answers['answers'] as $id => $checked) {
                    $internment = Internment::findOne($id);
                    /*If the internment has already linked with lote, then don`t link it*/
                    if (empty($internment->batch)) {
                        $atLeastOne = true;
                        $internment->batch_id = $batch->id;
                        $internment->save();
                    }
                }

                if ($atLeastOne) {
                    $transaction->commit();
                } else {

                    $batch = null;
                    $transaction->rollBack();
                }
            } else {
                $batch = null;
            }

        } catch (\Exception $e) {
            $batch = null;

            $transaction->rollBack();
        } catch (\Throwable $e) {
            $batch = null;
            $transaction->rollBack();
        }

        return $batch;
    }

    public function actionCreateDiagnostic()
    {
        $showForm = false;

        $model = new Batch();

        $searchModel = new DiagnosticAllSearch();

      

        if (empty(Yii::$app->request->queryParams['DiagnosticAllSearch'])) {
            $diagnostics = $searchModel->search([]);
        } else {
            $showForm = true;
            $diagnostics = $searchModel->search(Yii::$app->request->queryParams['DiagnosticAllSearch']);
        }        
        $answers = [];
        if (!empty(Yii::$app->request->post())) {
            $batch = $this->generateLoteDiag(Yii::$app->request->post());
            if (!empty($batch)) {
                return $this->redirect(['view', 'id' => $batch->id]);
            } else {
                $error_message = "Erro ao gerar lote! Tente novamente";
                return $this->render('create-diagnostic', [
                    'model' => $model,
                    'diagnostics' => $diagnostics,
                    'answers' => $answers,
                    'search' => $searchModel,
                    'showForm' => $showForm,
                    'error_message' => $error_message
                ]);
            }
        } else {

            return $this->render('create-diagnostic', [
                'model' => $model,
                'diagnostics' => $diagnostics,
                'answers' => $answers,
                'search' => $searchModel,
                'showForm' => $showForm
            ]);
        }
    }

    protected function generateLoteDiag($answers)
    {
        $transaction = Yii::$app->db->beginTransaction();
       
        $batch = null;
        try {
            $atLeastOne = false;
            $batch = new Batch();

            $batch->load(['Batch']);
            if ($batch->save()) {
                foreach ($answers['answers'] as $id => $checked) {
                    $diagnostic = Diagnostic::findOne($id);
                    /*If the internacao has already linked with lote, then don`t link it*/
                    if (empty($diagnostic->batch_id)) {
                        $atLeastOne = true;
                        $diagnostic->batch_id = $batch->id;
                        $diagnostic->save();
                    }
                }

                if ($atLeastOne) {
                    $transaction->commit();
                } else {


                    $batch = null;
                    $transaction->rollBack();
                }
            } else {
                $batch = null;
            }

        } catch (\Exception $e) {
            $batch = null;
            $transaction->rollBack();
        } catch (\Throwable $e) {
            $batch = null;
            $transaction->rollBack();
        }
        return $batch;
    }

    


    /**
     * Deletes an existing Batch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Batch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Batch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Batch::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionXml($id)
    {
        $batch = Batch::findOne($id);
        $file_name = "psicoclinica_lote_{$id}_" . date('dmy_his');
        if (!empty($batch->internments)) {
            $data = Internment::generateXML($batch, 1);

            header('Content-type: text/xml');
            header("Content-Disposition: attachment; filename={$file_name}_internacao.xml");
            
            echo $data;
            
            exit();
        } else {
            
            $data = Diagnostic::generateXML($batch, 1);
            header('Content-type: text/xml');
            header("Content-Disposition: attachment; filename={$file_name}_diagnostico.xml");

            echo $data;
            exit();
        }
    }

    

}
