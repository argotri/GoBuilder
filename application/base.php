<?php
class Application
{
    var $uri;
    var $model;
    var $db;
    function __construct($uri)
    {
        $this->uri = $uri;
        session_start();
		if($uri['controller'] != 'login'){ // Mengecek apakah Controler bukan Login
			if(!isset($_SESSION['user_detail'])){
				$this->redir('login','','','Anda Harus Login terlebih dahulu');
			}
		}
        /*$this->loadProduct("database_selector");
        $this->db = $this->database_selector->PilihDatabase();*/
    }
    function protocol() {
    	return stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
    }
 
    function loadController($class)
    {
        $file = "application/controller/".$this->uri['controller'].".php";
		/// Digunakan jika Tidak ada Controler yang diload (default controleer)
        if(!file_exists($file) && $this->uri['controller'] == NULL){ 
			// /$file = "application/controller/stats_harmonic_mean(.)";
            $file = "application/controller/".DEFAULT_CONTROLER.".php";
		//	require_once($file);
			$class = DEFAULT_CONTROLER;
		}
		/// Digunakan jika controler tidak ditemukan
		else if(!file_exists($file)){
			$file = "application/controller/".DEFAULT_404.".php";
			//require_once($file);
			$class = DEFAULT_404;
		}
		//End Default File System
        require_once($file);
        $controller = new $class();
        if(method_exists($controller, $this->uri['method']))
        {
            $controller->{$this->uri['method']}($this->uri['var']);
        } else {
            $controller->index();
        }
    }
 
    function loadView($view,$vars="")
    {
        if(is_array($vars) && count($vars) > 0)
            extract($vars, EXTR_PREFIX_SAME, "wddx");
        require_once('view/'.$view.'.php');
    }
 
    function loadModel($model)
    {
        require_once('model/'.$model.'.php');
        $this->$model = new $model;
    }
    function loadFactory($factory){
            require_once('factory/'.$factory.'.php');
    //$this->$factory = new $factory;
    }
    function loadProduct($product){
            require_once('produk/'.$product.'.php');
            $this->$product = new $product;
    }
    function loadAsset($tipe_aset , $url_aset,$property = ''){
            switch($tipe_aset){
                    case "img":
                            echo "<img src='".ASSET_FOLDER."/".$url_aset."' ".$property.">";
                            break;
                    case "css":
                            echo '<link rel="stylesheet" type="text/css" href="'.ASSET_FOLDER."/".$url_aset.'" />';
                            break; 
                    case 'js':
                            echo '<script type="text/javascript" src="'.ASSET_FOLDER."/".$url_aset.'"></script>';
                            break;
            }
    }
    function redir($class,$method = '',$parameter = '',$message = '') {
        $location = $this->protocol().URL_HOME."/".$class."/".$method."?".$parameter;
		if($message !=NULL){
			echo '<script type="text/javascript">alert("'.$message.'");</script>';
		}
        echo '<META http-equiv="refresh" content="0;URL='.$location.'">';
        die();
    }
    function renderUrl($class,$method="",$id="") {
    	if($id==NULL){
	    	echo $location = $this->protocol().URL_HOME."/".$class."/".$method;
    	}else 
    	{ 	if(!is_array($id)){
    			echo $location = $this->protocol().URL_HOME."/".$class."/".$method."/".$id;
    		}else{
    			$location = $this->protocol().URL_HOME."/".$class."/".$method;
    			foreach ($id as $value) {
    				$location .= "/".$value;
    			}
    			echo $location;
    		}
    	}
    }
    function url($url=''){
    	return $this->protocol().URL_HOME."/".$url;
    }
    function loadViewInclude($view) {
    	require_once('view/'.$view.'.php');
    }
    function normalisasiText($text){
    	return strtolower(preg_replace("/[^A-Za-z0-9]/", "", $text));
    }
    
 
	function loadExt($plugin){
		include("ext/".$plugin.".php");
	}
	
}
?>