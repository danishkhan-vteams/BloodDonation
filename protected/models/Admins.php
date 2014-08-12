<?php

/**
 * This is the model class for table "bd_admins".
 *
 * The followings are the available columns in table 'bd_admins':
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $notes
 * @property integer $is_active
 * @property string $created_by
 * @property string $created
 * @property string $modified_by
 * @property string $modified
 */
class Admins extends MyActiveRecord
{
	public $cPassword = null;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Admins the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bd_admins';
	}
	
	
	/*
	* Implementing some beforeValidate Activities
	*/
	public function beforeValidate()
	{
		if($this->isNewRecord)
		{
			$this->created_by = Yii::app()->user->id;
			$this->created = date("Ymdhis");
		}
		else
		{
			
		}
		$this->modified_by = Yii::app()->user->id;
		$this->modified = date("Ymdhis");		
		
		
		return parent::beforeValidate();
	}
	
	public function beforeSave()
	{
		if(!empty($_POST['Admins']) && !empty($this->password))
		{
			$this->password = $this->encrypting($this->password);
		}
		return parent::beforeSave();
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, username,  email, created_by, created, modified_by, modified', 'required'),
			array('password,cPassword', 'required','on'=>'create'),
			array('username','unique'),
			array('email','email'),
			array('email','unique'),
			array('cPassword', 'compare', 'compareAttribute'=> 'password','message'=> '{attribute} is incorrect.'),
			array('is_active', 'numerical', 'integerOnly'=>true),
			array('first_name, last_name', 'length', 'max'=>100),
			array('username, password', 'length', 'max'=>50),
			array('email', 'length', 'max'=>75),
			array('created_by, modified_by', 'length', 'max'=>5),
			array('password,cPassword,notes', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, username, password, email, notes, is_active, created_by, created, modified_by, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'_created_by'=>array(self::BELONGS_TO,'Admins','created_by'),
			'_modified_by'=>array(self::BELONGS_TO,'Admins','modified_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'username' => 'Username',
			'password' => 'Password',
			'cPassword' => 'Confirm Password',
			'email' => 'Email',
			'notes' => 'Notes',
			'is_active' => 'Status',
			'created_by' => 'Created By',
			'created' => 'Created',
			'modified_by' => 'Modified By',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function encrypting($value) {

		$site_key = Yii::app()->controller->core->salt;
		//hashing plain password with added salt
		return hash_hmac('sha256', $value, $site_key);
	}
	
	public function validatePassword($password)
	{
		//echo $this->encrypting($password)."===".$this->password; exit;
		return $this->encrypting($password)===$this->password;
	}
}