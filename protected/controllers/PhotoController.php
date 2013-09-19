<?php

class PhotoController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
    
    public function actionShot()
	{
		$this->renderPartial('index',null,false,true);
	}
    
    public function actionUpload()
    {
        preg_match('#^data:[\w/]+(;[\w=]+)*,[\w+/=%]+$#', $data=$_REQUEST['data']);
        $filename = uniqid().".png";
        copy($data, "photo-upload/".$filename);
        echo $filename;
    }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}