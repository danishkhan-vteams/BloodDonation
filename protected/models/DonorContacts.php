<?php

/**
 * This is the model class for table "bd_donor_contacts".
 *
 * The followings are the available columns in table 'bd_donor_contacts':
 * @property string $id
 * @property string $donor_id
 * @property string $contact_type
 * @property string $contact_number
 * @property string $ext
 * @property string $created_by
 * @property string $created
 * @property string $modified_by
 * @property string $modified
 */
class DonorContacts extends MyActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DonorContacts the static model class
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
		return 'bd_donor_contacts';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_type, contact_number,  created, modified', 'required'),
			array('contact_number','email','on'=>'Email'),
			array('donor_id','safe'),
			//array('donor_id', 'length', 'max'=>10),
			array('contact_type, ext, created_by, modified_by', 'length', 'max'=>5),
			array('contact_number', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, donor_id, contact_type, contact_number, ext, created_by, created, modified_by, modified', 'safe', 'on'=>'search'),
		);
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
	
	public function afterSave()
	{
		if(empty($this->created_by))
			$this->created_by = $this->donor_id;
		if(empty($this->modified_by))
			$this->modified_by = $this->donor_id;
			
		return parent::afterSave();
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
			'donor_id' => 'Donor',
			'contact_type' => 'Contact Type',
			'contact_number' => 'Contact Number',
			'ext' => 'Ext',
			'created_by' => 'Created By',
			'created' => 'Created',
			'modified_by' => 'Modified By',
			'modified' => 'Modified',
		);
	}

	/*
	* Getting Contact Type
	*/
	public function getContactType()
	{
		return array(
						'Email'=>'Email',
						'Phone'=>'Phone',
						'Cell'=>'Cell',
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
		$criteria->compare('donor_id',$this->donor_id,true);
		$criteria->compare('contact_type',$this->contact_type,true);
		$criteria->compare('contact_number',$this->contact_number,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}