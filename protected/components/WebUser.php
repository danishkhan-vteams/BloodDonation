<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebUser
 *
 * @author danish.khan
 */

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

  // Store model to not repeat query.
  private $_model;
	
  // Return first name.
  // access it by Yii::app()->user->first_name
  function getFirst_Name(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->getUserMeta('first_name');
  }

  function getFullName(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->getUserMeta('first_name')." ".$user->getUserMeta('last_name');
  }

	function showStartupMessage(){
    	$user = $this->loadUser(Yii::app()->user->id);
    	return $user->getUserMeta('show_startup_screen');
  }	
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  public function isAdmin(){
    if(!Yii::app()->user->isGuest){

        return Yii::app()->user->getState('role') == "admin";
    }
    else{
        return false;
    }
  }

 


  function getRole(){
      $user = $this->loadUser(Yii::app()->user->id);
      return $user->role;
  }

  function getParent(){
      $user = $this->loadUser(Yii::app()->user->id);
      return $user->parent_user;
  }
}
  
?>
