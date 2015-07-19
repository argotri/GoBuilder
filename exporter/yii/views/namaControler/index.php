<?php
/* @var $this NamaControlerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'{title}',
);

$this->menu=array(
	array('label'=>'Create {title}', 'url'=>array('create')),
	array('label'=>'Manage {title}', 'url'=>array('admin')),
);
?>

<h1>Nama Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
