<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        if (Yii::app()->user->isGuest)
            $this->redirect($this->createUrl('site/login'));
        
        $leads = Contact::model();
        $_lcriteria = new CDbCriteria();
        $_lcriteria->addCondition('contact_type = ' . 1);
        
        $litems = $leads->findAll($_lcriteria);
        $leadsCount = count($litems);
        
        $contact = Contact::model();
        $_criteria = new CDbCriteria();
        $_criteria->addCondition('contact_type = ' . 0);
        
        $citems = $contact->findAll( $_criteria);
        $contactsCount = count($citems);
        
		$this->render('index',array('leads'=>$leadsCount,'contacts'=>$contactsCount));
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

    public function actionPrint()
    {
        $this->layout = 'main_print';
        $this->render('print');
        //$this->renderPartial('print',null,false,true);
    }
    
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
        $this->layout = 'main_dark';
		$model=new ContactForm;
        $contact=new Contact;

		if(isset($_POST['ContactForm']))
		{
            $contact1 = $_POST['ContactForm'];
            $contact2 = $_POST['Contact'];

			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                $contact->name =  $contact1['name'];
                //$contact->address =  $contact2['address'];
                //$contact->sex =  $contact2['sex'];
                //$contact->birthdate =  $contact2['birthdate'];
                $contact->contact_number =  $contact2['contact_number'];
                $contact->email =  $contact1['email'];
                //$contact->course =  $contact2['course'];
                $contact->subject =  $contact1['subject'];
                $contact->message =  $contact1['body'];

                $contact->save(false);
                
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/html; charset=UTF-8";

                $message = '<html><body>';
                $message = '<h1>CONTACT-FORM</h1>';
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($contact1['name']) . "</td></tr>";
                $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($contact1['email']) . "</td></tr>";
                $message .= "<tr><td><strong>Contact Number:</strong> </td><td>" . strip_tags($contact2['contact_number']) . "</td></tr>";

                $message .= "<tr><td><strong>Message:</strong> </td><td>" . htmlentities($contact1['body']) . "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";
                    
				mail(Yii::app()->params['adminEmail'],'[CONTACT-FORM] '.$subject,$message,$headers);
                
                
                //auto response
                $adminEmail = Yii::app()->params['adminEmail'];
                $clientEmail = $contact1['email'];
                
                $name='=?UTF-8?B?'.base64_encode("Admin@Muzicskool.com").'?=';
				$subject='=?UTF-8?B?'.base64_encode("Muzic'skool.com [ASSESSMENT-FORM]").'?=';
				$headers="From: $name <{$adminEmail}>\r\n".
					"Reply-To: {$clientEmail}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";
                //$msg = "Your message has already been received by our team. One of our colleagues will contact you shortly. ";
                $msg = "Thank you for filling out our [contact] at Muzicskool!  We will contact you via your email or through sms with regards to your inquiry within 24 hours.";
				mail($clientEmail,$subject,$msg,$headers);
                
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model,'contact'=>$contact));
        //$this->renderPartial('contact',array('model'=>$model,'contact'=>$contact));
        
	}

    public function actionInquiry()
	{
        $this->layout = 'main_dark';
		$model=new ContactForm;
        $contact=new Contact;
        $course=new Course;
		if(isset($_POST['ContactForm']))
		{
            $contact1 = $_POST['ContactForm'];
            $contact2 = $_POST['Contact'];

			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
                $contact->name =  $contact1['name'];
                $contact->address =  $contact2['address'];
                $contact->sex =  $contact2['sex'];
                $contact->birthdate =  $contact2['birthdate'];
                $contact->contact_number =  $contact2['contact_number'];
                $contact->email =  $contact1['email'];
                $contact->course =  $contact2['course'];
                $contact->subject =  $contact1['subject'];
                $contact->message =  $contact1['body'];
                $contact->contact_type =1;
                $contact->save(false);
                
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/html; charset=UTF-8";
                   
                $message = '<html><body>';
                $message = '<h1>ASSESSMENT-FORM</h1>';
                $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
                $message .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . strip_tags($contact1['name']) . "</td></tr>";
                $message .= "<tr><td><strong>Email:</strong> </td><td>" . strip_tags($contact1['email']) . "</td></tr>";
                $message .= "<tr><td><strong>Contact Number:</strong> </td><td>" . strip_tags($contact2['contact_number']) . "</td></tr>";
                
                $message .= "<tr><td><strong>Address:</strong> </td><td>" . strip_tags($contact2['address']) . "</td></tr>";
                $message .= "<tr><td><strong>Sex:</strong> </td><td>" . strip_tags($contact2['sex']) . "</td></tr>";
                $message .= "<tr><td><strong>Birthdate:</strong> </td><td>" . strip_tags($contact2['birthdate']) . "</td></tr>";
                $message .= "<tr><td><strong>Course:</strong> </td><td>" . strip_tags($contact2['course']) . "</td></tr>";

                $message .= "<tr><td><strong>Message:</strong> </td><td>" . htmlentities($contact1['body']) . "</td></tr>";
                $message .= "</table>";
                $message .= "</body></html>";

				mail(Yii::app()->params['adminEmail'],'[ASSESSMENT-FORM] '.$subject,$message,$headers);
                
                $adminEmail = Yii::app()->params['adminEmail'];
                $clientEmail = $contact1['email'];
                
                $name='=?UTF-8?B?'.base64_encode("Admin@Muzicskool.com").'?=';
				$subject='=?UTF-8?B?'.base64_encode("Muzic'skool.com [ASSESSMENT-FORM]").'?=';
				$headers="From: $name <{$adminEmail}>\r\n".
					"Reply-To: {$clientEmail}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";
                //$msg = "Your message has already been received by our team. One of our colleagues will contact you shortly. ";
                $msg = "Thank you for filling out our [assessment] at Muzicskool!  We will contact you via your email or through sms with regards to your inquiry within 24 hours.";
				mail($clientEmail,$subject,$msg,$headers);
                
                
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
        $this->render('inquiry',array('model'=>$model,'contact'=>$contact,'course'=>$course));        
	}
    
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        $this->layout = 'main_login';
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

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}