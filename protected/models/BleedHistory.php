<?php

/**
 * This is the model class for table "bd_bleed_history".
 *
 * The followings are the available columns in table 'bd_bleed_history':
 * @property integer $id
 * @property integer $donor_id
 * @property string $bleed_date
 * @property string $notes
 * @property string $bleed_stamp
 * @property string $created_by
 * @property integer $created
 * @property string $modified_by
 * @property integer $modified
 */
class BleedHistory extends MyActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return BleedHistory the static model class
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
		return 'bd_bleed_history';
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
			$this->bleed_stamp = date("Ymdhis");
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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('donor_id, bleed_date, notes, bleed_stamp, created_by, created, modified_by, modified', 'required'),
			array('donor_id, created_by, modified_by', 'numerical', 'integerOnly'=>true),
			array('notes', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, donor_id, bleed_date, notes, bleed_stamp, created_by, created, modified_by, modified', 'safe', 'on'=>'search'),
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
			'bleed_date' => 'Bleed Date',
			'notes' => 'Notes',
			'bleed_stamp' => 'Bleed Stamp',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('donor_id',$this->donor_id);
		$criteria->compare('bleed_date',$this->bleed_date,true);
		$criteria->compare('notes',$this->notes,true);
		$criteria->compare('bleed_stamp',$this->bleed_stamp,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified_by',$this->modified_by,true);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}