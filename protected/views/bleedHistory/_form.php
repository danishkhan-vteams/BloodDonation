<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bleed-history-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<?php if(Yii::app()->user->isAdmin())
	{?>
	<div class="row">
		<?php echo $form->labelEx($model,'donor_id'); ?>
		<?php echo $form->dropDownList($model,'donor_id', CHtml::listData(Donors::model()->findAll(),'id','first_name')); ?>
		<?php echo $form->error($model,'donor_id'); ?>
	</div>
	<?php }
	else
	{ 
		echo $form->hiddenField($model,'donor_id');
	} ?>
	<div class="row">
		<?php echo $form->labelEx($model,'bleed_date'); ?>
        <?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'attribute'=>'bleed_date',
			'model'=>$model,
		));
		?>
		<?php echo $form->error($model,'bleed_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textField($model,'notes',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->