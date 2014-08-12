<?php
$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Requests', 'url'=>array('index')),
	array('label'=>'Create Requests', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('requests-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Requests</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.CustomGridView', array(
	'id'=>'requests-grid',
	'dataProvider'=>$model->search(),
        'gridActions'=>'ud',
	'columns'=>array(
		'id',
		'full_name',
		'email',
		'phone',
		'blood_group',
		'bleed_date',
		/*
		'location',
		'pickup',
		'notes',
		'is_report_sent',
		'created',
		'created_by',
		'modified',
		'modified_by',
		*/
	),
)); ?>
