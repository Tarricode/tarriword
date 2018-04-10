<?php 
	namespace frontend\controllers;

	use Yii;
	use yii\web\Controller;
	use frontend\models\Amigos;
	use yii\web\NotFoundHttpException;
	class AmigosController extends Controller
	{
		public function actionIndex()
		{
			if (Yii::$app->user->isGuest) {
				return $this->goHome();
			}
			if ((Amigos::find()->where(["Id_Usuario"=>Yii::$app->user->Id])->count()) !== "0" ) {
				$modelo=Amigos::find();
				$model=Amigos::find()->where(["Id_Usuario"=>Yii::$app->user->Id])->all();
				return $this->render("index",[
					"model"=>$model,
					"modelo"=>$modelo,
				]);
			}else{
				return $this->render("index");
			}
		}
	}

?>