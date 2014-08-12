<?php
$this->breadcrumbs=array(
	'Donors'=>array('index'),
	$model->first_name." ".$model->last_name,
);

$this->menu=array(
	array('label'=>'List Donors', 'url'=>array('index')),
	array('label'=>'Create Donors', 'url'=>array('create')),
);


?>

<h1>View Donor: <?php echo $model->first_name." ".$model->last_name;?></h1>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'first_name',
		'last_name',
		'username',
		'email',
		'blood_group',
		'notes',
		array(
			'name'=>'is_admin',
			'value'=>($model->is_admin=='1' ? "Admin" : "Donor"),
			),
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

<h3>Donor's Contact</h3>
<?php $this->widget('application.components.CustomGridView', array(
	'dataProvider'=>new CArrayDataProvider( $model->_contacts),
	'gridActions'=>'none',
	'columns'=>array(
		'contact_type',
		'contact_number',
		array(
			'name'=>'ext',
			'value'=>'!empty($data->ext) ? $data->ext : "-"'
		)
	),
)); ?>