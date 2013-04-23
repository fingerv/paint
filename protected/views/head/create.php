<?php

$this->menu=array(
	array('label'=>'Список головок','url'=>array('index')),
);
?>

<h1>Create Head</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>