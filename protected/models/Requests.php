<?php

/**
 * This is the model class for table "bd_requests".
 *
 * The followings are the available columns in table 'bd_requests':
 * @property integer $id
 * @property string $full_name
 * @property string $email
 * @property integer $phone
 * @property string $blood_group
 * @property string $bleed_date
 * @property string $location
 * @property integer $pickup
 * @property string $notes
 * @property integer $is_report_sent
 * @property string $created
 * @property integer $created_by
 * @property string $modified
 * @property integer $modified_by
 */
class Requests extends MyActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Requests the static model class
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
		return 'bd_requests';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, email, phone, blood_group, bleed_date, location, pickup, notes, is_report_sent, created, created_by, modified, modified_by', 'required'),
			array('phone, pickup, is_report_sent, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('full_name, email, location', 'length', 'max'=>255),
			array('blood_group', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, full_name, email, phone, blood_group, bleed_date, location, pickup, notes, is_report_sent, created, created_by, modified, modified_by', 'safe', 'on'=>'search'),
		);
	}
	
	/*
	* Implementing some beforeValidate Activities
	*/
	public function beforeValidate()
	{
		$this->bleed_date = strtotime($this->bleed_date);
		$this->bleed_date = date("Ymdhis",$this->bleed_date);
		if($this->isNewRecord)
		{
			$this->created_by = Yii::app()->user->id;
			$this->created = date("Ymdhis");
		}
		else
		{
			
		}
		if(!empty(Yii::app()->user->id))
		$this->modified_by = Yii::app()->user->id;
		$this->modified = date("Ymdhis");		
		
		
		return parent::beforeValidate();
	}


	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'full_name' => 'Full Name',
			'email' => 'Email',
			'phone' => 'Phone',
			'blood_group' => 'Blood Group',
			'bleed_date' => 'Bleed Date',
			'location' => 'Location',
			'pickup' => 'Pickup',
			'notes' => 'Notes',
			'is_report_sent' => 'Is Report Sent',
			'created' => 'Created',
			'created_by' => 'Created By',
			'modified' => 'Modified',
			'modified_by' => 'Modified By',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('blood_group',$this->blood_group,true);
		$criteria->compare('bleed_date',$this->bleed_date,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('pickup',$this->pickup);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('is_report_sent',$this->is_report_sent);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('created_by',$this->created_by);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('modified_by',$this->modified_by);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}