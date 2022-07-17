<?php

namespace app\controllers;

use Yii;
use app\models\Expense;
use app\models\Internment;
use app\models\InternmentProcedure;
use app\models\InternmentSearch;
use app\models\Medicine;
use app\models\Model;
use app\models\Procedure;
use app\models\Supply;
use Exception;
use app\utils\Formatter;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\widgets\ActiveForm;

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
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'create', 'create-extension', 'update', 'view', 'view-expense', 'manage-expense', 'delete-expense', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['index', 'create', 'create-extension', 'update', 'view', 'view-expense', 'manage-expense', 'delete-expense', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ]
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
        $model = $this->findModel($id);

        if ($model->isExtension()){
            return $this->render('view_extension', [
                'model' => $model,
            ]);
        }else{
            return $this->render('view', [
                'model' => $model,
            ]);
        }
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
        
        if ($model->isExtension()){
            return $this->render('update_extension', [
                'model' => $model,
            ]);
        }else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        
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


    public function actionViewExpense($id)
    {
        $model = $this->findModel($id);
        return $this->render('expenses/view_expense', [
            'model' => $model,
        ]);   
    }

    public function actionDeleteExpense($id)
    {
        if (($model = Expense::findOne(['id' => $id])) !== null) {
            $internment_id = $model->internment_id;
            $model->delete();
            return $this->redirect(['/internment/manage-expense/', 'id' => $internment_id]);
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));  
    }

    public function actionManageExpense($id)
    {

        $model = new Expense();

        $internment = Internment::findOne($id);

        $expenseModel = $internment->expense;

        if ($this->request->isPost) {
            $data = $this->request->post();
            $this->formatExpenseFormData($data['Expense']);
            if($model->load($data) && $model->save()){
                return $this->redirect(['/internment/manage-expense/', 'id' => $internment->id]);
            }else{
                print_r('<pre>');
                print_r($model->errors);die;
                die('aki'); 
            }
        }else{
            return $this->render('expenses/create', [
                'model' => $model,
                'internment' => $internment,
                'expenseModel' => (empty($expenseModel)) ? [new Expense] : $expenseModel
            ]);
        }
        
    }

    private function formatExpenseFormData(&$data)
    {
        
        
        if (!empty($data['despesa_code'])) {
            
            if ((int)$data['cd'] == 2) {
                $data['medicine_id'] =$data['despesa_code'];
                $data['supply_id'] = NULL;
                $data['procedure_id'] = NULL;

                $data['unit_price'] = Medicine::findOne($data['despesa_code'])->price;
            }

            if ((int)$data['cd'] == 3) {

                $data['supply_id'] = $data['despesa_code'];
                $data['medicine_id'] = NULL;
                $data['procedure_id'] = NULL;
                $data['unit_price'] = Supply::findOne($data['despesa_code'])->price;
            }

            if ((int)$data['cd'] == 5) {
                $data['procedure_id'] = $data['despesa_code'];
                $data['supply_id'] = NULL;
                $data['medicine_id'] = NULL;
                $data['unit_price'] = Procedure::findOne($data['despesa_code'])->price;
            }
            
            unset($data['despesa_code']);
        }

        $data['date'] = Formatter::unformatDate($data['date']);

    }

    public function actionExpenseList()
    {
        $data = [];;
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $list = [];
                $cd = $parents[0];
                //Medicamentos
                if ($cd == 2) {
                    $medicamentos = \app\models\Medicine::find()->all();
                    $list = ArrayHelper::map($medicamentos, 'id', 'description');
                }
                //Materiais
                if ($cd == 3) {
                    $materiais = \app\models\Supply::find()->all();
                    $list = ArrayHelper::map($materiais, 'id', 'description');
                }
                //Procedimentos
                if ($cd == 5) {
                    $procedimentos = \app\models\Procedure::find()->all();
                    $list = ArrayHelper::map($procedimentos, 'id', 'description');
                }

                $despesa = empty($_POST['depdrop_params'][0]) ? 0 : $_POST['depdrop_params'][0];

                foreach ($list as $key => $value) {
                    $data[] = ['id' => $key, 'name' => $value];
                }
                return Json::encode(['output' => $data, 'selected' => $despesa]);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
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
