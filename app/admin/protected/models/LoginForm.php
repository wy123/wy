<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{admin}}';
	}
	

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login() {
		
	}

}
