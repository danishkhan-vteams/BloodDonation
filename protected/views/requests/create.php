<?php
$this->breadcrumbs=array(
	'Requests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Requests', 'url'=>array('index')),
	array('label'=>'Manage Requests', 'url'=>array('admin')),
);
?>

<h1>Create Requests</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>