<?php

class DefaultControllerBase extends UTIController
{

    public $breadcrumbs = array('Панель управления' => array('/admin'));
    public $layout = '';

    public function init()
    {
        $this->breadcrumbs['Магазин подарков'] = $this->createUrl('index');
		$this->include_angular();
        parent::init();
    }

    public function Index()
    {
        //$this->checkAccess();
        $this->pageTitle = Yii::t('app', 'Магазин подарков');
		
	  /*
	   
	   for($i=100; $i< 200; $i++)
	   {  
			$store = new GiftsStoreHorders();
			$store->num = rand(100,999);
			$store->users__id = rand(26,100);
			$store->total_price = rand(10,10000);
			$store->commentary = 'Во время путешествия Воланда сопровождает его свита: Фагот (он же Коровьев), кот Бегемот, Азазелло, Гелла. Всех людей, вошедших в контакт с Воландом и его спутниками, преследуют наказания за свойственные им грехи и грешки: взяточничество, пьянство, эгоизм, жадность, равнодушие, ложь, грубость, имитацию деятельности…';
			$store->is_payed = rand(0,1);
			$store->war_warehouse__id = 1;
			$store->closed_at = date("Y-m-d H:i:s", strtotime('2015-'.rand(1,4).'-'.rand(1,28)));
			$store->save();
			
			$lang = new GiftsStoreOrders();
			$lang->gifts_horders__id = $store->id;
			$lang->gifts_products__id = rand(10,300);
			$lang->count = rand(1,10);
			$lang->price = rand(10,100);
			$lang->save();
		}*/
		
        $this->render('index');
    }

    public function include_angular()
    {
        $ScriptFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($ScriptFile))
        {
            $path = Yii::app()->assetManager->publish($ScriptFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular.min.js', CClientScript::POS_END 
            );
        }
		
		$ScriptFileJQ = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins';

        if (file_exists($ScriptFileJQ))
        {
            $path = Yii::app()->assetManager->publish($ScriptFileJQ) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'jquery-1.11.2.js', CClientScript::POS_HEAD 
            );
        }
		
		
		$RouteFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($RouteFile))
        {
            $path = Yii::app()->assetManager->publish($RouteFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular-route.min.js', CClientScript::POS_END 
            );
        }
		
		$SanitizeFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($SanitizeFile))
        {
            $path = Yii::app()->assetManager->publish($SanitizeFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular-sanitize.min.js', CClientScript::POS_END 
            );
        }
		
		$routeFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($routeFile))
        {
            $path = Yii::app()->assetManager->publish($routeFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular-route.js', CClientScript::POS_END 
            );
        }
		
		$bootstrapFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($bootstrapFile))
        {
            $path = Yii::app()->assetManager->publish($bootstrapFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'bootstrap.min.js', CClientScript::POS_END 
            );
        }
		
		$UIbootstrapFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($UIbootstrapFile))
        {
            $path = Yii::app()->assetManager->publish($UIbootstrapFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'ui-bootstrap-tpls-0.12.1.js', CClientScript::POS_END 
            );
        }
		
		$animateFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($animateFile))
        {
            $path = Yii::app()->assetManager->publish($animateFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular-animate.min.js', CClientScript::POS_END 
            );
        }
		
		$uploadFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'angular';

        if (file_exists($uploadFile))
        {
            $path = Yii::app()->assetManager->publish($uploadFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'angular-file-upload.js', CClientScript::POS_END 
            );
        }
		
//--------------------------------------------controllers+directives----------------------------------------------------

		$AppFile = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app';

        if (file_exists($AppFile))
        {
            $path = Yii::app()->assetManager->publish($AppFile) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'app.js', CClientScript::POS_END 
            );
        }
		
		
		$Ctr1File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr1File))
        {
            $path = Yii::app()->assetManager->publish($Ctr1File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsIndexController.js', CClientScript::POS_END 
            );
        }
		
		$Ctr2File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr2File))
        {
            $path = Yii::app()->assetManager->publish($Ctr2File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsProductsController.js', CClientScript::POS_END 
            );
        }
		
		$Ctr3File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr3File))
        {
            $path = Yii::app()->assetManager->publish($Ctr3File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsCreateProductsController.js', CClientScript::POS_END 
            );
        }
		
		$Ctr4File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr4File))
        {
            $path = Yii::app()->assetManager->publish($Ctr4File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsUpdateProductsController.js', CClientScript::POS_END 
            );
        }
		
		$Ctr5File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr5File))
        {
            $path = Yii::app()->assetManager->publish($Ctr5File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsHordersController.js', CClientScript::POS_END 
            );
        }
		
		$Ctr6File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers';

        if (file_exists($Ctr6File))
        {
            $path = Yii::app()->assetManager->publish($Ctr6File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'StoreGiftsUpdateHordersController.js', CClientScript::POS_END 
            );
        }
		
		$Dir1File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'services';

        if (file_exists($Dir1File))
        {
            $path = Yii::app()->assetManager->publish($Dir1File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'horders.js', CClientScript::POS_END 
            );
        }
		
		$Dir2File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'services';

        if (file_exists($Dir2File))
        {
            $path = Yii::app()->assetManager->publish($Dir2File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'products.js', CClientScript::POS_END 
            );
        }
		
		$Dir3File = $this->module->getBasePath() . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'directives';

        if (file_exists($Dir3File))
        {
            $path = Yii::app()->assetManager->publish($Dir3File) . '/';
			
            Yii::app()->clientScript->registerScriptFile(
                $path . 'thumb.js', CClientScript::POS_END 
            );
        }
		
		
    }
}
