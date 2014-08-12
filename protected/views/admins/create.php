<?php
$this->breadcrumbs=array(
	'Admins'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Admins', 'url'=>array('index')),
);
?>

<h1>Create Admins</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>