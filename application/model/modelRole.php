<?php
class modelRole extends Application
{
    function __construct()
    {
     	$this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();
    }
	function loadRole(){
		return $this->db->select("role");
	}
	function detailRole($id_role){
		$det =  $this->db->select("role"," id_role = ".$id_role);
		return $det[0];
	}
	function deleteForbiden($id_role){
		return $this->db->delete("forbiden_menu" , " id_role = ".$id_role);
	}
	function insertForbiden($id_role , $id_menu){
		$data['id_role'] = $id_role;
		$data['id_menu'] = $id_menu;
		return $this->db->insert("forbiden_menu",$data);
	}
	function insertRole($nama_role){
		$data['nama_role'] = $nama_role;
		return $this->db->insert("role",$data);
	}
	function editRole($nama_role , $id_role){
		$data['nama_role'] = $nama_role;
		return $this->db->edit("role"," id_role = ".$id_role,$data);
	}
	function deleteRole($id_role){
		return $this->db->delete("role" , "id_role = ".$id_role);
	}
}
?>