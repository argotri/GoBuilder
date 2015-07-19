<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'Data Barang'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Data Barang', 'url'=>array('index')),
	array('label'=>'Create Data Barang', 'url'=>array('create')),
	array('label'=>'View Data Barang', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Data Barang', 'url'=>array('admin')),
);
?>

<h1>Update Data Barang <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>