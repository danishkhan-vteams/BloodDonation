<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private  $_id = null;
	public $_role;
    /**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
//		$users=array(
//			// username => password
//			'demo'=>'demo',
//			'admin'=>'admin',
//		);

            $admins = Donors::model()->findByAttributes(array('username'=>$this->username,'is_active'=>'1'));
		if(!isset($admins))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if( !$admins->validatePassword($this->password))
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->_id = $admins->id;
			$auth=Yii::app()->authManager; //initializes the authManager
			if(!$auth->getAuthItem('donor'))
				$role=$auth->createRole('donor');
			if(!$auth->getAuthItem('admin'))	
			$role=$auth->createRole('admin');
			$role = $admins->is_admin == 1 ? "admin":"donor";
			$this->setState('role', $role);
			
			
			if(!$auth->isAssigned($role,$this->_id)) //checks if the role for this user has already been assigned and if it is NOT than it returns true and continues with assigning it below
			{
				if($auth->assign($role,$this->_id)) //assigns the role to the user
				{
					Yii::app()->authManager->save(); //saves the above declaration
				}
			}
			$this->errorCode=self::ERROR_NONE;
			return !$this->errorCode;
                }
	}
         /**
	 * Getting Logged in User id
	 */
        public function getId(){
            return $this->_id;
        }

       // This is a function that checks the field 'role'
      // in the User model to be equal to 1, that means it's admin
      // access it by Yii::app()->user->isAdmin()
      function isAdmin(){
        return intval($this->_role) == 'admin';
      }

}