<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'Data Barang'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Data Barang', 'url'=>array('index')),
	array('label'=>'Create Data Barang', 'url'=>array('create')),
	array('label'=>'Update Data Barang', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Data Barang', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Data Barang', 'url'=>array('admin')),
);
?>

<h1>View {namaModel} #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		/*
		'id',
		'nama',
		'alamat',*/
		{kolom_list}
	),
)); ?>
