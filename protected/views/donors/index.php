<?php
$this->breadcrumbs=array(
	'Donors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Donors', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('donors-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Donors</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.CustomGridView', array(
	'id'=>'donors-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'first_name',
		'last_name',
		'username',
		'email',
		'blood_group',
		array(
			'name'=>	'is_admin',
			'value'=>'$data->is_admin==1 ? "Admin":"Donor"'
		),
		array(
			'name'=>	'is_verified',
			'value'=>'Yii::app()->controller->core->getVerification($data->is_verified)'
		),	
		array(
			'name'=>	'is_active',
			'value'=>'Yii::app()->controller->core->getStatus($data->is_active)'
		),	
		/*
		'created_by',
		'created',
		'modified_by',
		'modified',
		*/
	),
)); ?>
