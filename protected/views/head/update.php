<?php

$this->menu=array(
	array('label'=>'Список головок','url'=>array('index')),
	array('label'=>'Создать головку','url'=>array('create')),
);
?>

<h2>Редактировать головку №<?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>