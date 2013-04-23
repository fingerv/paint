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
        $trans = Utils::translit($term);
        if($trans){
            $sql = 'SELECT id, model AS suggestion FROM printers WHERE (model LIKE :term OR model LIKE :tterm ) AND brand LIKE :brand';
            $results = Yii::app()->db
                ->createCommand($sql)
                ->queryAll(true, array('term' => $term . '%', 'tterm' => $trans . '%', 'brand' => $brand . '%'));
        }else{
            $sql = 'SELECT id, model AS suggestion FROM printers WHERE model LIKE :term AND brand LIKE :brand';
            $results = Yii::app()->db
                ->createCommand($sql)
                ->queryAll(true, array('term' => $term . '%', 'brand' => $brand . '%'));
        }

		echo json_encode($results);
		Yii::app()->end();
	}


	public function actionPrinterBrandSearch($term)
	{
        $trans = Utils::translit($term);
        if($trans){
            $sql = 'SELECT DISTINCT(brand) AS suggestion FROM printers WHERE brand LIKE :term OR brand LIKE :tterm';
            $results = Yii::app()->db
                ->createCommand($sql)
                ->queryAll(true, array('term' => $term . '%', 'tterm' => $trans . '%'));
        }else{
            $sql = 'SELECT DISTINCT(brand) AS suggestion FROM printers WHERE brand LIKE :term';
            $results = Yii::app()->db
                ->createCommand($sql)
                ->queryAll(true, array('term' => $term . '%'));
        }

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

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
            throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

        $model=new LoginForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model));
    }
}