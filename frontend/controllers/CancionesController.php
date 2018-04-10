<?php

namespace frontend\controllers;

use Yii;
use backend\models\Canciones;
use backend\models\Likes;
use backend\models\CancionesBuscar;
use frontend\models\Notificaciones;
use frontend\models\Genero;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\models\FormSearch;
use common\models\User;
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
    public function actions()
    {
        // $this->
    }
    public function actionIndex()
    {
        // $searchModel = new CancionesBuscar();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // verificamos autentisidad
        if (Yii::$app->user->isGuest) {
            //si no esta logueado retornamos a la pagina de inicio
            return $this->goHome();
        }

        // Solicitamos la foto de perfil del usuario para verificar que tenga una foto de perfil
        $foto=User::find()->where(["id"=>yii::$app->user->Id])->one()->Foto;
        // Verificamos si foto es igual a nulo
        if ($foto=="") {
            // de ser nulo mostraremos un mensaje sugiriendo que cargue una foto de perfil
            Yii::$app->session->setFlash('mensaje',"Bienvenido a Tarriworld.com te invitamos a que ingreses una foto de perfil.".Html::a("Subir foto de perfil",["site/fotos"]));
        }

        $form = new FormSearch;
                $search = null;
                $model=Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id])->orderBy('Fecha desc')->all();
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
    
                    $table = Canciones::find()->where(["IdUsuario"=>Yii::$app->user->Id])->orderBy('Fecha desc');
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
                $model=Canciones::find()->where(["Permiso"=>"1"])->all();
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
    
                    $table = Canciones::find()->where(["Permiso"=>1]);
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
        if (Canciones::find()->where(["Id"=>$id])->count()==0) {
                throw new NotFoundHttpException('La cancion no existe.');
                // return $this->redirect(['site/error']);
           }

      $model=Canciones::find()->where(["Id"=>$id])->one();  
        if (Yii::$app->user->isGuest) {
            if (Canciones::find()->where(["id"=>$id])->count()==0) {
                    $this->layout="main2";
                    return $this->redirect(['site/error']);
               }
            if ($model->Permiso==0) {   
                return $this->redirect(['site/login']);
            }else{
                $this->layout="main2";
                return $this->render('viewPublico', [
                    'model' => $this->findModel($id),
                ]);
            }
        }

        return $this->render('_viewTe', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Canciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /*
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
                $model->file->saveAs('images/mp3/'.$model->file->name);
                $model->Audio='images/mp3/'.$model->file->name;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->Id]);
            }

            if ($model->Genero2==!Null) {
                $genero2=Genero::find()->where(["Genero"=>$model->Genero2])->count();
                $genero=new Genero();
                if ($genero2==0) {
                    $genero->Genero=$model->Genero2;
                    $genero->save(false);
                    $nuevo=Genero::find()->where(["Genero"=>$model->Genero2])->one();
                    $model->Genero=$nuevo->Id;
                    $model->save(false);
                }
            }
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->Id]);
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
*/
        public function actionCreate()
        {
            if (Yii::$app->user->isGuest) {
                return $this->redirect(['site/login']);
            }

            $model = new Canciones();

            if ($model->load(Yii::$app->request->post())) {
                
                $model->file = UploadedFile::getInstance($model, 'file');
                if (!is_null($model->file)) {
                    # code...
                    $model->file->name=str_replace(" ", "_",$model->file->name);
                    $model->file->name=str_replace("Ñ", "n",$model->file->name);
                    $model->file->name=str_replace("ñ", "n",$model->file->name);
                    $model->file->name=str_replace("()", "",$model->file->name);
                    $model->file->saveAs('images/mp3/'.$model->file->name);
                    $model->Audio='images/mp3/'.$model->file->name;
                    $model->save(false);
                    return $this->redirect(['view', 'id' => $model->Id]);
                }

                if ($model->Genero2==!Null) {
                    $genero2=Genero::find()->where(["Genero"=>$model->Genero2])->count();
                    $genero=new Genero();
                    if ($genero2==0) {
                        $genero->Genero=$model->Genero2;
                        $genero->save(false);
                        $nuevo=Genero::find()->where(["Genero"=>$model->Genero2])->one();
                        $model->Genero=$nuevo->Id;
                        $model->save(false);
                    }
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
/*
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
            $model->file->saveAs( 'images/mp3/'.$model->file->name);
            if (file_exists(file_exists(yii::getAlias("@frontend")."/web/images/mp3/".$model->Audio))) {
                # code...
            unlink('images/mp3/'.$model->Audio);
            }
            $model->Audio=$model->file->name;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->Id]);
        }
        if ($model->Genero2==!Null) {
            $genero2=Genero::find()->where(["Genero"=>$model->Genero2])->count();
            $genero=new Genero();
            if ($genero2==0) {
                $genero->Genero=$model->Genero2;
                $genero->save(false);
                $nuevo=Genero::find()->where(["Genero"=>$model->Genero2])->one();
                $model->Genero=$nuevo->Id;
                $model->save(false);
            }
        }
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->Id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
*/

    public function actionUpdate($id)
    {
        // primero verificamos que este autentificado el usuario
        //de lo contrario lo retrocedemos al login
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        // hacemos una busqueda del registro que vamos actualizar
        $model = $this->findModel($id);

        // verificamos que haya registros en la post
        // para determinar si mostramos el formulario o enviamos datos
        if ($model->load(Yii::$app->request->post())) {

            // verificamos si hay datos en el formulario file
            $model->file = UploadedFile::getInstance($model, 'file');
            // vemos si el formulario file esta vacio o no
            // $model->file!==Null
            if (!is_null($model->file)) {
                // cambiamos el nombre por texto que no den errores futuros
                $model->file->name=str_replace(" ", "_",$model->file->name);
                $model->file->name=str_replace("Ñ", "n",$model->file->name);
                $model->file->name=str_replace("ñ", "n",$model->file->name);
                $model->file->name=str_replace("()", "",$model->file->name);

                    unlink('images/mp3/'.$model->Audio);

                    $model->file->saveAs( 'images/mp3/'.$model->file->name);
                    $model->Audio=$model->file->name;
                    $model->save(false);
                    return $this->redirect(['view', 'id' => $model->Id]);

            }else{//else de file vacio o no
                // var_dump($model->file);
                // die();
             
                // si file esta vacio significa que no hay archivos que cargar
                // por lo tanto solo guardaremos registros de texto
                if ($model->save(false)) {
                    return $this->redirect(['view', 'id' => $model->Id]);
                }else{
                    // mandamos un mensaje de error en el caso de que haya error al guardar los datos
                    Yii::$app->session->setFlash('mensaje',"Uvo Un error al guardar los datos.");
                    //renderisamos al update
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
        }
        //renderizamos en el caso que no haya registros enviados
        return $this->render('update', [
            'model' => $model,
        ]);
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

    public function actionT()
    {
        $models = Canciones::find()->all();
        foreach ($models as $model) {
            $model->Audio = yii::getAlias("@recursos")."/".$model->Audio;
            $model->update(false); // skipping validation as no user input is involved
        }
        return true;
    }

        public function actionY()
    {
        $models = Canciones::find()->all();
        foreach ($models as $model) {
            $model->Genero="1";
            $model->update(false); // skipping validation as no user input is involved
        }
        return true;
    }

    public function actionPublicar($id)
    {
        $model=Canciones::findOne($id);
        if ($model->Permiso==1) {
            $model->Permiso=0;
            $model->save(false);
            return $this->redirect(['view',"id"=>$id]);
        }else{
            $model->Permiso=1;
            $model->save(false);
            return $this->redirect(['view',"id"=>$id]);
        }
    }

    public function actionMegusta()
    {
        $notific=new Notificaciones;
        $id=$_POST["id"];
        $canciones = Likes::find()->where(["Id_Usuario"=>Yii::$app->user->Id, "Id_Caciones"=>(int)$id]);
        if ($canciones->count()>0) {
            $canciones=$canciones->one();
            $canciones->delete();
            return 0;
        }else{
            $canciones=new Likes;
            // var_dump($canciones);
            // die();
            $canciones->Id_Usuario=Yii::$app->user->Id;
            $canciones->Id_Caciones=(int)$id;
            $canciones->save(false);
            // $verificar=Notificaciones::find()->where(["Id_Item"=>(int)$id])->count();
            // if ($verificar>0) {
                # code...
            $notific->Id_Usuario=Canciones::find()->where(['Id'=>(int)$id])->one()->IdUsuario;
            $notific->Id_Item=(int)$id;
            $notific->Tipo="Notificacion";
            $notific->Area="Canciones";
            $notific->Descripcion="Tu Cancion ".Canciones::find()->where(['Id'=>(int)$id])->one()->Titulo." recibio un like para llegar a un total de ".Likes::find()->where(["Id_Caciones"=>(int)$id])->count()." likes";
            $notific->Fecha_Creacion=Date("Y-m-d");
            $notific->save(false);
            // }
            return 1;
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
