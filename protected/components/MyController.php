<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MyController extends Controller
{
	public $core = null;
	public $thumbnail = null;
	public $statusArr;
	/*
	* Setting up all neccessary settings
	*
	*/
	public function init()
	{
		$this->core = new Core;
		
		parent::init();
	}
	
	

}