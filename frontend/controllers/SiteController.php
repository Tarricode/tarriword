<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\Fotos;
use frontend\models\FormUpload;
use frontend\models\Configuracion;
use frontend\models\Genero;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Canciones;
use yii\web\UploadedFile;
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                        'class' => 'yii\authclient\AuthAction',
                        'successCallback' => [$this, "successCallback"],
                    ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout="main2";
        return $this->render('index');
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
            // user login or signup comes here
            /*
            Checking facebook email registered yet?
            Maxsure your registered email when login same with facebook email
            die(print_r($attributes));
            */
            
            $user = \common\modules\auth\models\User::find()->where(["email"=>$attributes["email"]])->one();
            if(!empty($user)){
                Yii::$app->user->login($user);
            
            }else{
                // Save session attribute user from FB
                $session = Yii::$app->session;
                $session["attributes"]=$attributes;
                // redirect to form signup, variabel global set to successUrl
                $this->successUrl = \yii\helpers\Url::to(["signup"]);
            }
    }
    public $successUrl = 'Success';

    public function actionIntro()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(["login"]);
        }
        // llamamos todo los datos
        $usuario=User::find()->where(["id"=>Yii::$app->user->Id])->one();
        return $this->render("intro",[
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
     public function actionDeletefoto($id)
     {
        $foto=Fotos::find()
            ->where(["Id"=>$id,"IdUsuario"=>yii::$app->user->Id])
            ->one();

                if (file_exists(yii::getAlias("@frontend")."/web/".$foto->Url)){
                    if (unlink(yii::getAlias("@frontend")."/web/".$foto->Url)) {
                        $foto->delete();
                        $usuario=User::find()
                            ->where(["id"=>yii::$app->user->Id])->one();
                            $usuario->Foto=Null;
                            $usuario->save(false);

                        return $this->redirect(["site/fotos"]);
                    }
                }else{
            
                if (file_exists(yii::getAlias("@backend")."/web/".$foto->Url)){
                    if (unlink(yii::getAlias("@backend")."/web/".$foto->Url)) {
                        $foto->delete();

                        $usuario=User::find()
                            ->where(["id"=>yii::$app->user->Id])->one();
                            $usuario->Foto=Null;
                            $usuario->save(false);

                        return $this->redirect(["site/fotos"]);
                    }
                    
                }
            }
            var_dump($foto);
        
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
             return $this->redirect(["site/intro"]);
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

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout="loginLayout";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $foto=User::find()->where(["id"=>yii::$app->user->Id])->one()->Foto;
            if ($foto=="") {
                Yii::$app->session->setFlash('mensaje',"Bienvenido a Tarriworld.com te invitamos a que ingreses una foto de perfil.");
            }
            
            return $this->redirect(["canciones/index"]);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }


    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionPolitica()
    {
        return $this->render('politica');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->layout="main2";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                  $configuracion=new Configuracion();
                  $configuracion->Id_Usuario=Yii::$app->user->Id;
                  $configuracion->Vista="1";
                  if ($configuracion->save(false)) {
                      return $this->redirect(["canciones/index"]);
                  }
                  echo "Error";
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $this->layout="main2";
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */

    public function actionGenero($id)
    {
        $model=Genero::find()->where(["genero"=>$id])->all();
        // $model=[
        //     {
        //       title: $mode->Id,
        //       description: $model,
        //     },
        // ];

        echo  json_encode($model);
    }

    public function actionVistaclasica()
    {
        $config=Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Vista"=>1]);
        if ($config->count()>0) {
            return $this->redirect(["canciones/index"]);
        }else{
            $config=Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Vista"=>2])->one();
            $config->Vista="1";
            $config->update(false);
            return $this->redirect(["canciones/index"]);
        }
    }

    public function actionVistalista()
    {
        $config=Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Vista"=>2]);
        if ($config->count()>0) {
            return $this->redirect(["canciones/index"]);
        }else{
            $config=Configuracion::find()->where(["Id_Usuario"=>yii::$app->user->Id,"Vista"=>1])->one();
            $config->Vista="2";
            $config->update(false);
            return $this->redirect(["canciones/index"]);
        }
    }

    public function actionEliminarcuenta($id)
    {
        $models=User::find()->where(["id"=>$id])->one();
        $models->delete();

        $canciones=Canciones::find()->where(["IdUsuario"=>$id])->all();
        foreach ($canciones as $model) {
            
            if (file_exists(yii::getAlias("@frontend")."/web/images/mp3/".$model->Audio)){
                if (unlink(yii::getAlias("@frontend")."/web/images/mp3/".$model->Audio)) {
                    $model->delete();
                    echo "eliminado caniones";
                }
            }else{
        
            if (file_exists(yii::getAlias("@backend")."/web/images/mp3/".$model->Audio)){
                if (unlink(yii::getAlias("@backend")."/web/images/mp3/".$model->Audio)) {
                    $model->delete();
                }
                
            }
        }


        }
        $fotos=Fotos::find()->where(["IdUsuario"=>$id])->all();
        foreach ($fotos as $model) {
            
            if (file_exists(yii::getAlias("@frontend")."/web".$model->Url)){
                if (unlink(yii::getAlias("@frontend")."/web".$model->Url)) {
                    $model->delete();
                    echo "eliminado fotos";
                }
            }else{
        
            if (file_exists(yii::getAlias("@backend")."/web".$model->Url)){
                if (unlink(yii::getAlias("@backend")."/web".$model->Url)) {
                    $model->delete();
                    echo "Eliminado";
                }
                
            }
        }
        echo "No se encontraron archivos con estos registros";



        }
    
    }

    public function actionError()
    {
        $this->layout="main2";                
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }


    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
