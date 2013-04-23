<?php

$this->menu=array(
	array('label'=>'Список принтеров','url'=>array('index')),
);
?>

<h2>Новый принтер</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>