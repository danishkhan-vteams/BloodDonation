<?php

class DonorsController extends MyController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('*'),
				'expression'=>'Yii::app()->request->isAjaxRequest',
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','view','create','update','deleteContact','admin','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($k=1)
	{
		$this->processCreation($k);
	}
	
	public function processCreation($k=1)
	{
		$model=new Donors;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		$donarContacts[0] = new DonorContacts();
		if(isset($_POST['Donors']))
		{
			$model->attributes=$_POST['Donors'];
			$valid = true;
				
				if(isset($_POST['DonorContacts']))
				{
					$donarContacts = array();
					foreach($_POST['DonorContacts'] as $item)
					{
						$tmpContact = new DonorContacts();
						$tmpContact->attributes=$item;
						$tmpContact->setScenario($tmpContact->contact_type);
						
						if(!$tmpContact->validate()){
							$valid= false;
						}
						if(!$valid){$model->addErrors($tmpContact->getErrors());}
						$donarContacts[] = $tmpContact;
						
					}
					if($valid && $model->save())
					{
						foreach((array) $donarContacts as $contact)
						{
							$contact->donor_id = $model->id;
							$contact->save();
						}
						if(Yii::app()->user->isGuest)
						{
							Yii::app()->user->setFlash('register','Thank you for registration. We will respond to you as soon as possible.');
							$this->redirect(array('/'));
						}
						else
						{
							$this->redirect(array('view','id'=>$model->id));
						}
					}

				}else{
					$model->addError('created','Atleast one contact should be filled in');
				}
				
				
				
			
			
				
	}
		
		
		 if (Yii::app()->request->isAjaxRequest) {
                    $data = $this->renderPartial('//donors/_form_donors_contact', array('donarContact' => $donarContacts[0], 'k' => $k), true/* return */, true/* process output    */);
                    echo json_encode(array('data' => $data, 'k' => $k + 1));
         } else {
			if(Yii::app()->user->isGuest)
				$this->render('//site/index',array(
					'model'=>$model,
					'donarContacts'=>$donarContacts,
				));
			else
				$this->render('//donors/create',array(
					'model'=>$model,
					'donarContacts'=>$donarContacts,
				));
		 }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->password ='';
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$donarContacts = $model->_contacts;
		if(isset($_POST['Donors']))
		{
			$model->attributes=$_POST['Donors'];
			if($valid = $model->validate())
			{
				$donarContacts = array();
				if(isset($_POST['DonorContacts']))
				{
					foreach($_POST['DonorContacts'] as $item)
					{
						$tmpContact = $this->loadDonorContactModel($item['id']);
						$tmpContact->attributes=$item;
						$tmpContact->setScenario($tmpContact->contact_type);
						
						if(!$tmpContact->validate()){
							$valid= false;
						}
						if(!$valid){$model->addErrors($tmpContact->getErrors());}
						$donarContacts[] = $tmpContact;
						
					}
					if($valid && $model->save())
					{
						foreach((array) $donarContacts as $contact)
						{
							$contact->donor_id = $model->id;
							$contact->save();
						}
						$this->redirect(array('view','id'=>$model->id));
					}

				}else{
					$model->addError('created','Atleast one contact should be filled in');
				}
				
				
				
			}
			
				
		}
		
		
		 if (Yii::app()->request->isAjaxRequest) {
                    $data = $this->renderPartial('_form_donors_contact', array('donarContact' => $donarContacts[0], 'k' => $k), true/* return */, true/* process output    */);
                    echo json_encode(array('data' => $data, 'k' => $k + 1));
         } else {

			$this->render('update',array(
				'model'=>$model,
				'donarContacts'=>$donarContacts,
			));
		 }
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/*
         * Delete Contact By ID....
         */
         public function actionDeleteContact($id=""){
             if(Yii::app()->request->isAjaxRequest){
              $model = $this->loadDonorContactModel($id);
              if($model!=null){
                  $model->delete();
                  echo json_encode(array('status'=>'ok','msg'=>"Contact has been removed successfully."));
              }else{
                  echo json_encode(array('status'=>'err','msg'=>"Contact cannot be deleted."));
              }

             }
         }

	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
		$model=new Donors('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Donors']))
			$model->attributes=$_GET['Donors'];

		$this->render('index',array(
			'model'=>$model,
		));
	}
	
	/*
	* Load Donor's Contact Model
	*/
	public function loadDonorContactModel($id)
	{
		$model= DonorContacts::model()->findByPk((int)$id);
		if($model===null)
			$model = new DonorContacts();
		return $model;
	}
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Donors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='donors-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
