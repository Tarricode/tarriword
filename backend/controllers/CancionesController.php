<?php

namespace backend\controllers;

use Yii;
use backend\models\Canciones;
use backend\models\Likes;
use backend\models\CancionesBuscar;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\models\FormSearch;
use yii\helpers\Html;
use yii\web\UploadedFile;
/**
 * CancionesController implements the CRUD actions for Canciones model.
 */
class CancionesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Canciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $searchModel = new CancionesBuscar();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new FormSearch;
                $search = null;
                $model=Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id])->all();
                if($form->load(Yii::$app->request->get()))
                {
                    if ($form->validate())
                    {
                        $search = Html::encode($form->q);

                        $model2=Canciones::find()
                        ->where(["like", "Titulo", $search])
                        ->orWhere(["like", "Letra", $search])
                        ->orWhere(["like", "detalle", $search]);
                        $count=Canciones::find()->where(["Titulo"=>$search])->count();
                         // $count2 = clone $model;
                                         $pages = new Pagination([
                                             "pageSize" => 12,
                                             "totalCount" => $count,
                                         ]);
                                         $model = $model2
                                                 ->offset($pages->offset)
                                                 ->limit($pages->limit)
                                                 ->all();
                    }
                    else
                    {
                        $form->getErrors();
                    }
                }
                else
                {
    
                    $table = Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id]);
                    $count = Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id])->count();
                    $pages = new Pagination([
                        "pageSize" => 12,
                        "totalCount" => $count,
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                }

   
        if ($count>0) {
            $mensaje=null;
        }else{
            $mensaje="no se necontraron registros";
        }
        return $this->render('index', [
            "model"=>$model,
            "mensaje"=>$mensaje,
            "pages"=>$pages,
            "form"=>$form,
            "search"=>$search,
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }

    public function actionTodas()
    {
        // $searchModel = new CancionesBuscar();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new FormSearch;
                $search = null;
                $model=Canciones::find()->all();
                if($form->load(Yii::$app->request->get()))
                {
                    if ($form->validate())
                    {
                        $search = Html::encode($form->q);

                        $model2=Canciones::find()
                        ->where(["like", "Titulo", $search])
                        ->orWhere(["like", "Letra", $search])
                        ->orWhere(["like", "detalle", $search]);
                        $count=Canciones::find()->where(["Titulo"=>$search])->count();
                         // $count2 = clone $model;
                                         $pages = new Pagination([
                                             "pageSize" => 12,
                                             "totalCount" => $count,
                                         ]);
                                         $model = $model2
                                                 ->offset($pages->offset)
                                                 ->limit($pages->limit)
                                                 ->all();
                    }
                    else
                    {
                        $form->getErrors();
                    }
                }
                else
                {
    
                    $table = Canciones::find();
                    $count = Canciones::find()->count();
                    $pages = new Pagination([
                        "pageSize" => 12,
                        "totalCount" => $count,
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                }

    
        if ($count>0) {
            $mensaje=null;
        }else{
            $mensaje="no se necontraron registros";
        }
        return $this->render('index', [
            "model"=>$model,
            "mensaje"=>$mensaje,
            "pages"=>$pages,
            "form"=>$form,
            "search"=>$search,
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCanciones($id)
    {
        // $searchModel = new CancionesBuscar();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new FormSearch;
                $search = null;
                $model=Canciones::find()->where(["IdUsuario"=>$id])->all();
                if($form->load(Yii::$app->request->get()))
                {
                    if ($form->validate())
                    {
                        $search = Html::encode($form->q);

                        $model2=Canciones::find()
                        ->where(["like", "Titulo", $search])
                        ->orWhere(["like", "Letra", $search])
                        ->orWhere(["like", "detalle", $search]);
                        $count=Canciones::find()->where(["Titulo"=>$search])->count();
                         // $count2 = clone $model;
                                         $pages = new Pagination([
                                             "pageSize" => 12,
                                             "totalCount" => $count,
                                         ]);
                                         $model = $model2
                                                 ->offset($pages->offset)
                                                 ->limit($pages->limit)
                                                 ->all();
                    }
                    else
                    {
                        $form->getErrors();
                    }
                }
                else
                {
    
                    $table = Canciones::find()->where(["IdUsuario"=>$id]);
                    $count = Canciones::find()->where(["IdUsuario"=>$id])->count();
                    $pages = new Pagination([
                        "pageSize" => 12,
                        "totalCount" => $count,
                    ]);
                    $model = $table
                            ->offset($pages->offset)
                            ->limit($pages->limit)
                            ->all();
                }

    
        if ($count>0) {
            $mensaje=null;
        }else{
            $mensaje="no se necontraron registros";
        }
        return $this->render('index', [
            "model"=>$model,
            "mensaje"=>$mensaje,
            "pages"=>$pages,
            "form"=>$form,
            "search"=>$search,
            // 'searchModel' => $searchModel,
            // 'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Canciones model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Canciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new Canciones();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file!==Null) {
                # code...
                $model->file->name=str_replace(" ", "_",$model->file->name);
                $model->file->name=str_replace("Ñ", "n",$model->file->name);
                $model->file->name=str_replace("ñ", "n",$model->file->name);
                $model->file->name=str_replace("()", "",$model->file->name);
                $model->file->saveAs( 'images/mp3/'.$model->file->name.'.'.$model->file->extension);
                $model->Audio=$model->file->name.'.'.$model->file->extension;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->Id]);
            }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->Id]);
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Canciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

        if ($model->file!==Null) {
            $model->file->name=str_replace(" ", "_",$model->file->name);
            $model->file->name=str_replace("Ñ", "n",$model->file->name);
            $model->file->name=str_replace("ñ", "n",$model->file->name);
            $model->file->name=str_replace("()", "",$model->file->name);
            $model->file->saveAs( 'images/mp3/'.$model->file->name.'.'.$model->file->extension);
            unlink('images/mp3/'.$model->Audio);
            $model->Audio=$model->file->name.'.'.$model->file->extension;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->Id]);
        }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Canciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMegusta()
    {
        $id=$_POST["id"];
        $canciones = Likes::find()->where(["Id_Usuario"=>Yii::$app->user->Id, "Id_Caciones"=>$id]);
        if ($canciones->count()>0) {
            $canciones=$canciones->one();
            $canciones->delete();
            return "false";
        }else{
            $canciones=new Likes;
            // var_dump($canciones);
            // die();
            $canciones->Id_Usuario=Yii::$app->user->Id;
            $canciones->Id_Caciones=$id;
            $canciones->save(false);
            return "true";
        }
    }

    /**
     * Finds the Canciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Canciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Canciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
