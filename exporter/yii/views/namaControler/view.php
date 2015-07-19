<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'{title}'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List {title}', 'url'=>array('index')),
	array('label'=>'Create {title}', 'url'=>array('create')),
	array('label'=>'Update {title}', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete {title}', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage {title}', 'url'=>array('admin')),
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
