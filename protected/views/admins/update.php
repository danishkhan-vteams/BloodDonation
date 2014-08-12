<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	$model->first_name." ".$model->last_name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Manage Admins', 'url'=>array('index')),
	array('label'=>'View '.$model->first_name." ".$model->last_name, 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Update Admin: <?php echo $model->first_name." ".$model->last_name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>