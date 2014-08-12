<?php
$this->breadcrumbs=array(
	'Bleed Histories',
);

$this->menu=array(
	array('label'=>'Create BleedHistory', 'url'=>array('create')),
	array('label'=>'Manage BleedHistory', 'url'=>array('admin')),
);
?>

<h1>Bleed Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
