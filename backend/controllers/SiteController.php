<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\FormUpload;
use backend\models\Fotos;
use backend\models\Canciones;
use yii\web\UploadedFile;
use common\models\User;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','admin','fotouplader','fotos','selectfoto','perfil','user','sample'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout="loginLayout";
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(["site/admin"]);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(["site/admin"]);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    // Mis acciones personalizadas

    public function actionAdmin()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["login"]);
        }
        // llamamos todo los datos
        $usuario=User::find()->where(["id"=>Yii::$app->user->Id])->one();
        return $this->render("admin",[
            "usuario"=>$usuario,
        ]);

    }

    public function actionFotouplader()
    {

        $fotos=new Fotos;
        $model = new FormUpload;
        $msg = null;

        if ($model->load(Yii::$app->request->post()))
        {
            $model->file = UploadedFile::getInstances($model, 'file');

            if ($model->file && $model->validate()) {
                foreach ($model->file as $file) {
                    $file->saveAs('images/perfil/' . $file->baseName . '.' . $file->extension);
                    $fotos->Titulo=$file->baseName;
                    $fotos->Url='/images/perfil/' . $file->baseName . '.' . $file->extension;
                    $fotos->Tipo=$file->extension;
                    $fotos->IdUsuario=Yii::$app->user->Id;


                    $msg = "<p><strong class='label label-info'>Enhorabuena, subida realizada con éxito</strong></p>";
                }
                    $fotos->save(false);
            }
        }
        return $this->render("upload", ["model" => $model, "msg" => $msg,"foto"=>$fotos->Url]);
    }

    public function actionFotos()
    {
        $fotos=Fotos::find()
            ->where(["IdUsuario"=>yii::$app->user->Id])
            ->all();
        return $this->render("fotos", [
            "model"=>$fotos
        ]);
    }
    public function actionSelectfoto($id)
    {
        $foto=Fotos::find()
            ->where(["Id"=>$id])
            ->one();
        $usuario=User::find()
            ->where(["id"=>yii::$app->user->Id])->one();

        $usuario->Foto=$foto->Url;
        if ($usuario->save(false)) {
            return $this->redirect(["site/admin"]);
        }else{
            return $this->redirect(["site/fotos"]);
        }
    }

    public function actionPerfil($id)
    {
        $perfil=User::find()
            ->where(["id"=>$id])
            ->one();
        return $this->render("perfil",[
            "perfil"=>$perfil
        ]);
    }

    public function actionUser()
    {
        // verificamos que este login
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["site/login"]);
        }
        // buscamos todo los usuarios registrados
        $model=User::find()->all();
        return $this->render("user",[
            "model"=>$model,
        ]);
    }

   public function actionSample()
   {
   if (Yii::$app->request->isAjax) {
       $data = Yii::$app->request->post();
       $dataId= explode(":", $data['id']);
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
       // $dataId=(int)$dataId;
       $cancion=Canciones::findOne($dataId);
        // ->where(["Id"=>$dataId])
        // ->one();
       
        $g=$cancion["Titulo"];
       return [
           'dataId' => $g,
       ];
     }
   }
}
