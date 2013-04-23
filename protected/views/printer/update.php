<?php

$this->menu=array(
	array('label'=>'Список принтеров','url'=>array('index')),
	array('label'=>'Создать принтер','url'=>array('create')),
);
?>

<h2>Редактировать принтер №<?php echo $model->id; ?></h2>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
