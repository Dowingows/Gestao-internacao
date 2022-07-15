<?php

namespace app\controllers;

use Yii;
use app\models\Batch;
use app\models\BatchSearch;
use app\models\Diagnostic;
use app\models\Internment;
use app\models\InternmentAllSearch;
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
            $lote = $this->generateLote($this->request->post());
            if (!empty($lote)) {
                return $this->redirect(['view', 'id' => $lote->id]);
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

    protected function generateLoteDiag($answers)
    {
        $transaction = Yii::$app->db->beginTransaction();

        $lote = null;
        try {
            $atLeastOne = false;
            $lote = new Lote();

            $lote->load(['Lote']);
            if ($lote->save()) {
                foreach ($answers['answers'] as $id => $checked) {
                    $diagnostico = Diagnostico::findOne($id);
                    /*If the internacao has already linked with lote, then don`t link it*/
                    if (empty($diagnostico->lote_id)) {
                        $atLeastOne = true;
                        $diagnostico->lote_id = $lote->id;
                        $diagnostico->save();
                    }
                }

                if ($atLeastOne) {
                    $transaction->commit();
                } else {


                    $lote = null;
                    $transaction->rollBack();
                }
            } else {
                $lote = null;
            }

        } catch (\Exception $e) {
            print_r($e);
            die;
            $lote = null;
            $transaction->rollBack();
        } catch (\Throwable $e) {
            print_r($e);
            die;
            $lote = null;
            $transaction->rollBack();
        }
        return $lote;
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

    public function actionCreateLoteDiagnostico()
    {
        $showForm = false;

        $model = new Lote();

        $search = new DiagnosticoAllSearch();


        if (empty(Yii::$app->request->queryParams['DiagnosticoAllSearch'])) {
            $diagnosticos = [];
        } else {

            $showForm = true;
            $diagnosticos = $search->search(Yii::$app->request->queryParams);

        }

        $answers = [];


        if (!empty(Yii::$app->request->post())) {
            $lote = $this->generateLoteDiag(Yii::$app->request->post());
            if (!empty($lote)) {
                return $this->redirect(['view', 'id' => $lote->id]);
            } else {
                $error_message = "Erro ao gerar lote! Tente novamente";
                return $this->render('create-diagnostico', [
                    'model' => $model,
                    'diagnosticos' => $diagnosticos,
                    'answers' => 'answers',
                    'search' => $search,
                    'showForm' => $showForm,
                    'error_message' => $error_message
                ]);
            }
        } else {

            return $this->render('create-diagnostico', [
                'model' => $model,
                'diagnosticos' => $diagnosticos,
                'answers' => 'answers',
                'search' => $search,
                'showForm' => $showForm
            ]);
        }
    }

}
