<?php

/**
 * Parent Model Class.
 *
 * Class is developed to work as a parent of all model classes those need to extend "CActiveRecord"
 */
class MyActiveRecord  extends CActiveRecord
{
	
	/*
	* Before Validate trimming all 
	*/
	public function beforeValidate()
	{
		$attribs = $this->getAttributes();
		if(!empty($attribs))
		{
			foreach($attribs as $k=>$v)
			{
			 	if(!empty($v) && !is_array($v))
					$this->$k = trim($v);	
			}
		}
		return parent::beforeValidate();
	}
	
	public function processMessage($message)
	{
		return serialize($message);
	}
	
	//User Logs....
	public function saveUserLog($event){
		
		$logMaker = new Logs();
		$user = $event->sender;
		if($user->role=='admin')
		{
			$logMaker->processAdminUserLogs($user);
		}
		else if($user->role=='advertiser')
		{
			$logMaker->processAdvertiserLogs($user);
		}
		else if($user->role=='aduser')
		{
			$logMaker->processAdUserLogs($user);
		}
		
	}
	
	public function saveUserMetaLog($event){
		
		$logMaker = new Logs();
		$item = $event->sender;
		$logMaker->processUserMetaLogs($item);
		
	}
	
	
	
	public function delUserLog($event)
	{
		$logMaker = new Logs();
		$user = $event->sender;
		if($user->role=='admin')
		{
			$logMaker->processAdminUserLogs($user,'delete');
		}
		else if($user->role=='advertiser')
		{
			$logMaker->processAdvertiserLogs($user,'delete');
		}
		else if($user->role=='aduser')
		{
			$logMaker->processAdUserLogs($user,'delete');
		}
	}
	//User Logs....
	
	
	//Rate Logs
	public function saveRateLog($event)
	{
		$logMaker = new Logs();
		$rate = $event->sender;
		$logMaker->processRateLogs($rate);
	}
	
	//Ground CPI 
	public function saveGCPILog($event)
	{
		$logMaker = new Logs();
		$rate = $event->sender;
		$logMaker->processGCPILogs($rate);
	}
	//Ground CPI 
	
	//Rate Logs
	
	
	//Ads Logs...
	public function saveAdLog($event)
	{
		$logMaker = new Logs();
		$ad = $event->sender;
		$logMaker->processAdsLogs($ad);
	}
	
	public function delAdLog($event)
	{
		$logMaker = new Logs();
		$item = $event->sender;
		$logMaker->processAdsLogs($item,'delete');
	}
	
	//Ad Network Log...
	public function saveAdNetworkLog($event){
		
		$logMaker = new Logs();
		$item = $event->sender;
		$logMaker->processAdNetworkLog($item);
		
	}
	
	
	//Ad Network Log...
	
	//Ads Logs...
	
	//Speciality Logs...
	public function saveSpecialityLog($event)
	{
		$logMaker = new Logs();
		$speciality = $event->sender;
		$logMaker->processSpecialityLogs($speciality);
	}
	//delete speciality
	public function delSpecialityLog($event)
	{
		$logMaker = new Logs();
		$speciality = $event->sender;
		$logMaker->processSpecialityLogs($speciality,'delete');
	}
	//Speciaiity Logs...
	
	//Procedure Logs...
	public function saveProcedureLog($event)
	{
		$logMaker = new Logs();
		$speciality = $event->sender;
		$logMaker->processProcedureLogs($speciality);
	}
	//delete Procedure
	public function delProcedureLog($event)
	{
		$logMaker = new Logs();
		$speciality = $event->sender;
		$logMaker->processProcedureLogs($speciality,'delete');
	}
	//Procedure Logs...
	
}