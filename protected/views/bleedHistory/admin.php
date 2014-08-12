<?php
$this->breadcrumbs=array(
	'Bleed Histories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BleedHistory', 'url'=>array('index')),
	array('label'=>'Create BleedHistory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bleed-history-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Bleed Histories</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('application.components.CustomGridView', array(
	'id'=>'bleed-history-grid',
	'dataProvider'=>$model->search(),
        'gridActions'=>'ud',
	'columns'=>array(
		'id',
		'donor_id',
		'bleed_date',
		'notes',
		'bleed_stamp',
		'created_by',
		/*
		'created',
		'modified_by',
		'modified',
		*/
	),
)); ?>
