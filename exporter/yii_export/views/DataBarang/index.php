<?php
/* @var $this NamaControlerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Data Barang',
);

$this->menu=array(
	array('label'=>'Create Data Barang', 'url'=>array('create')),
	array('label'=>'Manage Data Barang', 'url'=>array('admin')),
);
?>

<h1>Nama Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
