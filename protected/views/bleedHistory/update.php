<?php
$this->breadcrumbs=array(
	'Bleed Histories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BleedHistory', 'url'=>array('index')),
	array('label'=>'Create BleedHistory', 'url'=>array('create')),
	array('label'=>'View BleedHistory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BleedHistory', 'url'=>array('admin')),
);
?>

<h1>Update BleedHistory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>