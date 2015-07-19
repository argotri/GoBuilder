<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'Model'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Data Barang', 'url'=>array('index')),
	array('label'=>'Manage Data Barang', 'url'=>array('admin')),
);
?>

<h1>Create Data Barang</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>