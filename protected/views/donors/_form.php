<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'donors-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model,'first_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'first_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model,'last_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'last_name'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>	
    
    <div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'cPassword'); ?>
		<?php echo $form->passwordField($model,'cPassword',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cPassword'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model,'blood_group'); ?>
		<?php echo $form->dropDownList($model,'blood_group',$model->getBloodGroups()); ?>
		<?php echo $form->error($model,'blood_group'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>
    <h3> Donor's Contact Numbers</h3>
    
    <div class="row">
	    <?php
            $indx = 0;
            foreach((array) $donarContacts as $k=>$item){
                $indx=$k+1;
                $this->renderPartial('//donors/_form_donors_contact', array('donarContact'=>$item,'k'=>$k));
            }
        ?>
            <div id="forAjaxRefresh"></div>
               <?php echo CHtml::hiddenField('counter',$indx,array('id'=>'counter')) ;?>
                     <?php echo CHtml::ajaxLink("+ Add another contact",CHtml::normalizeUrl(array('/donors/create','render'=>false)),
                        array('success'=>'js: function(data) {
                        $("#forAjaxRefresh").append(data.data);
                        $("#counter").val(data.k);}',
                         'dataType'=>'json','data'=>array('k'=>'js:$("#counter").val()'))); ?>
    </div>    
	
    
     <?php if(Yii::app()->user->isGuest) 
	{ ?>
	    <?php echo $form->hiddenField($model,'is_admin',array('value'=>0)); ?>
		<?php echo $form->hiddenField($model,'is_active',array('value'=>Yii::app()->controller->core->STATUS_ACTIVE)); ?>
        <?php echo $form->hiddenField($model,'is_verified',array('value'=>Yii::app()->controller->core->UNVERIFIED)); ?>
    <?php 
	}
	else
	{?>
        <div class="row">
            <?php echo $form->labelEx($model,'is_admin'); ?>
            <?php echo $form->checkBox($model,'is_admin'); ?>
            <?php echo $form->error($model,'is_admin'); ?>
        </div>
        
        <div class="row"><?php echo $this->id;?>
            <?php echo $form->labelEx($model,'is_active'); ?>
            <?php echo $form->dropDownList($model,'is_active',Yii::app()->controller->core->getStatusList()); ?>
            <?php echo $form->error($model,'is_active'); ?>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($model,'is_verified'); ?>
            <?php echo $form->dropDownList($model,'is_verified',Yii::app()->controller->core->getVerificationList()); ?>
            <?php echo $form->error($model,'is_verified'); ?>
        </div>
	<?php 
	} ?>
    
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? (Yii::app()->user->isGuest ? 'Register' : 'Create') : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->