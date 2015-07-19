<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelLoginUser
 *
 * @author argotriwidodo
 */
class modelLoginUser extends Application{
    //put your code here
    public function __construct() {
    	
        $this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();
    }
    public $username;
    public $id_role;
    public function login($username , $password) {
    	session_start();
        $user = $this->db->login($username,$password);
        //$_SESSION['user_detail'] = $user[0];
        if($user != NULL){
			$_SESSION['user_detail']=$user[0];
            $_SESSION['username']=$user[0]['username'];
            $_SESSION['role'] = $user[0]['id_role'];
            return true;
        }else{
            return false;
        }
    }
    public function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['role']);
		unset($_SESSION['userdetail']);
        session_destroy();
        return true;
    }
    public function cekLogin() {
    	//Buat Cek Role Juga ini ya :3
    	// Jangan Lupa Sesi ID Rolenya adalah $_SESSION['role'];
        if(!isset($_SESSION['username'])){
            $this->redir('login');
        }
    } 
    
}
