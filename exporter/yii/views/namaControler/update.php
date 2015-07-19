<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'{title}'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List {title}', 'url'=>array('index')),
	array('label'=>'Create {title}', 'url'=>array('create')),
	array('label'=>'View {title}', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage {title}', 'url'=>array('admin')),
);
?>

<h1>Update {title} <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>