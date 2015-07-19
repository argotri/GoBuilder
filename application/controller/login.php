<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author argotriwidodo
 */
class login extends Application {
    //put your code here
    public function __construct() {
        $this->loadModel(modelLoginUser);
		$this->loadModel("modelMenu");
    }
    function  index(){
        $this->loadView(login);
    }
    public function doLogin() {
    	session_start();
    	$result =$this->modelLoginUser->login($_POST['username'],$_POST['password']);
        if($result){
			// Mengambil Menu
			$_SESSION['menu'] = $this->modelMenu->getMenu($_SESSION['role']);
            $this->redir('home');
        }else{
            $this->redir('login','','gagal');
        }
    }
    public function logout() {
    	if($this->modelLoginUser->logout()){
    		$this->redir('login','','logout');
    	}
    }
}
