<?php

class SiteController extends Controller
{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	public function actionWidget()
	{
		header('Accept-Charset:utf-8;');

		$this->renderPartial('widget');
	}

	public function actionPrinterModelSearch($brand, $term)
	{
		$sql = 'SELECT id, model AS suggestion FROM printers WHERE model LIKE :term AND brand LIKE :brand';
		$results = Yii::app()->db
			->createCommand($sql)
			->queryAll(true, array('term' => $term . '%', 'brand' => $brand . '%'));

		echo json_encode($results);
		Yii::app()->end();
	}


	public function actionPrinterBrandSearch($term)
	{
		$sql = 'SELECT DISTINCT(brand) AS suggestion FROM printers WHERE brand LIKE :term';
		$results = Yii::app()->db
			->createCommand($sql)
			->queryAll(true, array('term' => $term . '%'));

		echo json_encode($results);
		Yii::app()->end();
	}


	public function actionHeadModelSearch($brand, $term)
	{

		$sql = 'SELECT id, model AS suggestion FROM heads WHERE model LIKE :term AND brand LIKE :brand';
		$results = Yii::app()->db
			->createCommand($sql)
			->queryAll(true, array('term' => $term . '%', 'brand' => $brand . '%'));
		echo json_encode($results);
		Yii::app()->end();
	}

	public function actionHeadBrandSearch($term)
	{
		$sql = 'SELECT DISTINCT(brand) AS suggestion FROM heads WHERE brand LIKE :term';
		$results = Yii::app()->db
			->createCommand($sql)
			->queryAll(true, array('term' => $term . '%'));

		echo json_encode($results);
		Yii::app()->end();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}