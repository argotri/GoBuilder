
<?php
class modelUser extends Application
{
    function __construct()
    {
     	$this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();
    }
	function insertUser($data){
		$data['password'] = md5($data['password']);
		return $this->db->insert("user",$data);
	}
	function loadUser(){
		return $this->db->select("user");
	}
	function loadUserDetail($id_user){
		$det =  $this->db->select("user", " id_user = ".$id_user );
		return $det[0];
	}
	function editUser($id_user , $data){
		return $this->db->edit('user' , 'id_user = '.$id_user,$data) ;
	}
	function deleteUser($id_user){
		return $this->db->delete('user' , 'id_user = '.$id_user);
	}
}
?>