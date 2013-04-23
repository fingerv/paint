<?php

$this->menu=array(
	array('label'=>'Создать краску','url'=>array('create')),
	array('label'=>'Просмотр краски','url'=>array('view','id'=>$model->id)),
	array('label'=>'Список красок','url'=>array('index')),
);
?>

<h1>Краска №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>