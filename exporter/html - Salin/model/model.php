<?php
class {model} extends Application
{
    function __construct()
    {
     	$this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();
    }

    function select()
    {
        return $this->db->kirim_query("Select * from test");
    }
	function tambah($tabel , $data){
		return $this->db->insert($tabel , $data);
	}
	function edit($tabel , $data){
		$id_edit = $data['id'];
		unset($data['id']);
		return $this->db->edit($tabel , " id = ".$id_edit , $data);
	}
	function delete($tabel ,$id_delete){
		return $this->db->delete($tabel  , 'id = '.$id_delete);
	}
}
?>