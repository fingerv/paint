<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../../../../Downloads/yii-1.1.12.b600af.tar/yii-1.1.12.b600af/framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

Yii::createWebApplication($config);
