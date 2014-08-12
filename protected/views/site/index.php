<?php $this->pageTitle=Yii::app()->name; ?>

<?php
$this->breadcrumbs=array(
	'Register Yourself'=>array('/'),

);
?>

<?php if(Yii::app()->user->hasFlash('register')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('register'); ?>
</div>

<?php else: ?>
<h1>Register Yourself</h1>

<?php echo $this->renderPartial('//donors/_form', array('model'=>$model,'donarContacts'=>$donarContacts)); ?>
<?php endif; ?>
