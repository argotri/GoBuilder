<?php
class Home extends Application
{
    function __construct()
    {
        $this->loadModel('modelLoginUser');
        $this->loadModel('modelMenu');
        $this->modelLoginUser->cekLogin();
    }
    
    function index()
    {	
//		$data['menu'] = $
        $this->loadView('home',$data);
    }
 
   
}
?>