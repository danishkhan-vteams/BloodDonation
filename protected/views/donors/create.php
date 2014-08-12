<?php
$this->breadcrumbs=array(
	'Donors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Donors', 'url'=>array('index')),

);
?>

<h1>Create Donors</h1>

<?php echo $this->renderPartial('//donors/_form', array('model'=>$model,'donarContacts'=>$donarContacts)); ?>