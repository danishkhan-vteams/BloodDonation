<?php
$this->breadcrumbs=array(
	'Bleed Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BleedHistory', 'url'=>array('index')),
	array('label'=>'Manage BleedHistory', 'url'=>array('admin')),
);
?>

<h1>Create BleedHistory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>