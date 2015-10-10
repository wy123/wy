<?php
/**
 * The followings are the available columns in table 'tbl_comment':
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 */
class Base extends CActiveRecord
{	
	public static $tableName;
	
	public function __construct($table_name = '') {
		
		if ($table_name === null) {
			parent::__construct ( null );
		} else {
			self::$tableName = $table_name;
			parent::__construct ();
		}
	}
	
	public static function model($table_name = '', $className = __CLASS__) {
		
		self::$tableName = $table_name;	
		return parent::model ( $className );
	}
	
	public function tableName() {		
		return "{{".self::$tableName."}}";
	}

}