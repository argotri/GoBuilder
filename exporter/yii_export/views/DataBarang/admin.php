<?php
/* @var $this NamaControlerController */
/* @var $model namaModel */

$this->breadcrumbs=array(
	'Data Barang'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List namaModel', 'url'=>array('index')),
	array('label'=>'Create namaModel', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#nama-model-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Data Barang</h1>

<p>
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'nama-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		/*
		'id',
		'nama',
		'alamat',*/
		id,
namabarang1,
jumlah2,

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
