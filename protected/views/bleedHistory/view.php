<?php
$this->breadcrumbs=array(
	'Bleed Histories'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BleedHistory', 'url'=>array('index')),
	array('label'=>'Create BleedHistory', 'url'=>array('create')),
	array('label'=>'Update BleedHistory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BleedHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BleedHistory', 'url'=>array('admin')),
);
?>

<h1>View BleedHistory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'donor_id',
		'bleed_date',
		'notes',
		'bleed_stamp',
		'created_by',
		'created',
		'modified_by',
		'modified',
	),
)); ?>
