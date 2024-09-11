<?php

namespace backend\controllers;

use Exception;
use Yii;
use backend\models\Books;
use backend\models\BooksSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
              'class'=> AccessControl::className(),
              'rules' => [
                [
                  'allow' => true,
                  'roles' => ['@'],
                ]
              ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {
      $searchModel = new BooksSearch();
      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

      return $this->render('index', [
          'searchModel' => $searchModel,
          'dataProvider' => $dataProvider,
      ]);
      
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      if(Yii::$app->user->can('create-book'))
      {
        
        $model = new Books();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
          
          // Fájl példányának mentése a megadott könyvtárba, szerző - cím néven
          $imageName = $model->book_author.' - '.$model->book_title;
          $model->file = UploadedFile::getInstance($model,'file');
          $model->file->saveAs('uploads/books'.$imageName.'.'.$model->file->extension);
          
          // Elérési út mentése az adatbázisba
          $model->book_img = 'uploads/books'.$imageName.'.'.$model->file->extension;
          
          return $this->redirect(['view', 'id' => $model->book_id]);
        } else {
          return $this->renderAjax('create', [
            'model' => $model,
          ]);
        }
      } else {
        echo 'Nem vagy jogosult új könyvet felvenni!';
        // throw new ForbiddenHttpException();
      }
    }
    
    // Excel fájl importálása
    public function actionImportExcel()
    {
      $inputFile = 'uploads/books.xlsx';

      try {

        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFile);

      } catch (Exception $e) {

        die('Error');

      }

      $sheet = $objPHPExcel->getSheet(0);
      $highestRow = $sheet->getHighestRow();
      $highestColumn = $sheet->getHighestColumn();

      for ($row = 1; $row < $highestRow ; $row++) { 
        $rowData = $sheet->rangeToArray('A'. $row.':'.$highestColumn.$row,NULL,TRUE,FALSE);

        if ($row == 1 ) {
          continue;
        }
      }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->book_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
