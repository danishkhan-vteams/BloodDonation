<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
		$model->first_name." ".$model->last_name
);

$this->menu=array(
	array('label'=>'Manage Admins', 'url'=>array('index')),
	array('label'=>'Create Admins', 'url'=>array('create')),
	array('label'=>'Update Admins', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Admins', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Admin: <?php echo 	$model->first_name." ".$model->last_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'username',
		'email',
		'notes',
		array(
			'name'=>'is_active',
			'value'=>$this->core->getStatus($model->is_active),
			),
		array(
			'name'=>'created_by',
			'value'=>$model->_created_by->first_name." ".$model->_created_by->last_name
			),
		'created',
		array(
				'name'=>'modified_by',
				'value'=>$model->_created_by->first_name." ".$model->_created_by->last_name
			),
		'modified',
	),
)); ?>
