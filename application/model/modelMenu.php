<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelHome
 *
 * @author argotriwidodo
 */
class modelMenu extends Application {

    //put your code here
    public function __construct() {
        $this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();
    }
	
    public function getMenu($id_role) {
		$whereForm = " (id_menu NOT IN ( SELECT fb.id_menu FROM forbiden_menu as fb , role as rl WHERE fb.id_role  = rl.id_role AND rl.id_role = ".$id_role.") AND id_form IS NOT NULL) ";
		$whereLap = " id_menu NOT IN ( SELECT fb.id_menu FROM forbiden_menu as fb , role as rl WHERE fb.id_role  = rl.id_role AND rl.id_role = ".$id_role.") AND id_laporan IS NOT NULL";
		$menu['form'] = $this->db->select("menu",$whereForm);
		$menu['report'] = $this->db->select("menu",$whereLap);
		return $menu;
    }
	public function getForbidenMenu($id_role){ // DIgunakan Untuk meload Menu Role yang forbiden
		$this->db->select("menu, forbiden_menu", "menu.id_menu = forbiden_menu.id_menu" );
	}
	public function getDetailMenu($id_menu){
		$menu = $this->db->select("menu"," id_menu = ".$id_menu," id_form ASC ");
		return $menu[0];
	}
	public function getListMenu(){
		return $this->db->select("menu",""," id_form ASC ");
	}
	public function insertMenu($data){
		return $this->db->insert("menu",$data);
	}
	public function editMenu($data,$id_menu){
		return $this->db->edit("menu", " id_menu = ".$id_menu,$data);
	}
	public function deleteMenu($id_menu){
		$this->db->delete("forbiden_menu"," id_menu = ".$id_menu);
		return $this->db->delete("menu"," id_menu = ".$id_menu);
	}
}
