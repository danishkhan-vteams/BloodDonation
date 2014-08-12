<?php
$this->breadcrumbs=array(
	'Requests'=>array('index'),
	$model->id,
);
$status = $model->status==$this->core->STATUS_ACTIVE ? $this->core->STATUS_INACTIVE : $this->core->STATUS_ACTIVE ;
$statusLbl = $this->core->getStatus($status);
$this->menu=array(
	array('label'=>'List Requests', 'url'=>array('index')),
	array('label'=>'Create Requests', 'url'=>array('create')),
	array('label'=>'Update Requests', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=> "Put ".$statusLbl,'url'=>'#', 'linkOptions'=>array('submit'=>array('status','id'=>$model->id,'status'=>$status),'confirm'=>'Are you sure you want to put this user '.$statusLbl.'?') ),
	array('label'=>'Delete Requests', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Requests', 'url'=>array('admin')),
);
?>

<h1>View Requests #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'full_name',
		'email',
		'phone',
		'blood_group',
		'bleed_date',
		'location',
		'pickup',
		'notes',
		'is_report_sent',
		'created',
		'created_by',
		'modified',
		'modified_by',
	),
)); ?>
