<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'Model'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List {title}', 'url'=>array('index')),
	array('label'=>'Manage {title}', 'url'=>array('admin')),
);
?>

<h1>Create {title}</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>