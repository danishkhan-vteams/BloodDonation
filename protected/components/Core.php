<?php
/**
 * CoreMethods is the customized helper class for basic functions.
 */
Yii::import('application.modules.email_tpls.models.*');
class Core extends CApplicationComponent
{
		public $salt = "BLOOD";
        public  $STATUS_ACTIVE ='1';
        public  $STATUS_INACTIVE = '0';
		public  $VERIFIED ='1';
        public  $UNVERIFIED ='0';
	    public $statusArr = array('1'=>'Active','0'=>"In-active");
		public $verificationArr = array('1'=>'Verified','0'=>"Un-verified");
		
		function getVerificationList(){
                return $this->verificationArr;
        }

        function getVerification($key){
                return $this->pickData($key,$this->verificationArr);
        }
		
        function getStatusList(){
                return $this->statusArr;
        }

        function getStatus($key){
                return $this->pickData($key,$this->statusArr);
        }

        

        function pickData($key, $data){
            
            
            if(array_key_exists($key, $data))
                    return $data[$key];
            else
                return "";
        }


        /*
         * get User name
         */
        public function getUser($id){
            $user = User::model()->findByPk($id);
            return $user;
        }
        

        

        /*
         * Date Format
         */
        public function dateFormat($dt){
            return date("m-d-Y g:i a", strtotime($dt));
        }
		
        /*
         * Phone Mask
         */
        public function phoneMask()
		{
            return '999-999-9999';
        }
        
        /*
         * No Record Found Message
         */
        public function noRecordFound()
		{
            return 'Sorry No Record Found!';
        }
		
		
		//TypoGraph html content...
		public function typograph($txt)
		{
			$typograph =  new Typography();
			return $typograph->auto_typography($txt);
		}
}

?>