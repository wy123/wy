<?php

class SiteController extends Controller {
	public $layout = 'column1';

	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'captcha' => array('class' => 'CCaptchaAction', 'backColor' => 0xFFFFFF, ),
		// page action renders "static" pages stored under 'protected/views/site/pages'
		// They can be accessed via: index.php?r=site/page&view=FileName
		'page' => array('class' => 'CViewAction', ), );
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app() -> errorHandler -> error) {
			if (Yii::app() -> request -> isAjaxRequest)
				echo $error['message'];
			else
				$this -> render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact() {
		$model = new ContactForm;
		if (isset($_POST['ContactForm'])) {
			$model -> attributes = $_POST['ContactForm'];
			if ($model -> validate()) {
				$headers = "From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app() -> params['adminEmail'], $model -> subject, $model -> body, $headers);
				Yii::app() -> user -> setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
				$this -> refresh();
			}
		}
		$this -> render('contact', array('model' => $model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin() {
		//$admin = new LoginForm;
		//$admin = LoginForm::model() -> deleteAll('id in(2,3)');
		//echo $admin[0]['username'];
		//
		//$admin -> id = '4';
		//$admin -> username = '16346555454';
		//$admin -> save ();
		//die ;.
		//$admin = LoginForm::model() -> findAll(array('select' => 'username'), 'id in (5,6)');
		$admin = yii::app()->db->createCommand()->select('*')->from('tbl_admin a')->join('tbl_user b','a.id = b.ids')->where('id=5')-> queryAll();
		//echo $admin[0]['username'];
		print_r($admin);

		die ;

		// if it is ajax validation request
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app() -> end();
		}

		// collect user input data
		if (isset($_POST['LoginForm'])) {
			$model -> attributes = $_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if ($model -> validate() && $model -> login())
				$this -> redirect(Yii::app() -> user -> returnUrl);
		}
		// display the login form
		$this -> render('login', array('model' => $model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout() {
		Yii::app() -> user -> logout();
		$this -> redirect(Yii::app() -> homeUrl);
	}

}
