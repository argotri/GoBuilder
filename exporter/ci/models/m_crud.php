<?php
class {model_firstBig}_crud extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function m_lihat(){
		$lihat = $this->db->get('{tabel}');
		return $lihat->result();

	}
	function m_tambah_act($data){
		$this->db->insert('{tabel}',$data);
	}
	function m_hapus($data){
		$this->db->delete('{tabel}',$data);
	}
	function m_edit($data){
		$this->db->where($data);
		$edit = $this->db->get('{tabel}');
		return $edit->result();
	}
	function m_update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('{tabel}',$data);
	}
}

?>