<?php
	
	namespace YiiMan\Setting\assets;
	
	use kartik\select2\Select2Asset;
	use yii\web\View;
	use yii\bootstrap\BootstrapAsset;
	use yii\web\AssetBundle;
	use yii\web\YiiAsset;
	
	/**
	 * Created by YiiMan TM.
	 * Programmer: gholamreza beheshtian
	 * Mobile:09353466620
	 * Site:http://yiiman.ir
	 * Date: 12/29/2018
	 * Time: 2:43 PM
	 */
	class FileManagerAsset extends AssetBundle {
		
		public function init() {
			parent::init(); // TODO: Change the autogenerated stub
			$this->sourcePath = realpath( __DIR__ . '/files' );
	
		}
		
		public $js =
			[
				'bootstrap.min.js' ,
				'angular-translate.min.js' ,
				'ng-file-upload.min.js' ,
				'angular-filemanager.min.js' ,
				'jqueryCookie.js' ,

			];
		public $css =
			[
				'angular-filemanager.min.css'
			];
		
		
		public $jsOptions = [ 'position' => View::POS_HEAD ];
		
		public $depends =
			[
				'yii\web\YiiAsset' ,
				'yii\bootstrap\BootstrapAsset' ,
				'kartik\select2\Select2Asset',
				'system\assets\angular\AngularJsAssets',
				
			];
		
	}