<?php
class ModelDataBarang_crud extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function m_lihat(){
		$lihat = $this->db->get('Data_barang');
		return $lihat->result();

	}
	function m_tambah_act($data){
		$this->db->insert('Data_barang',$data);
	}
	function m_hapus($data){
		$this->db->delete('Data_barang',$data);
	}
	function m_edit($data){
		$this->db->where($data);
		$edit = $this->db->get('Data_barang');
		return $edit->result();
	}
	function m_update($data,$id){
		$this->db->where('id', $id);
		$this->db->update('Data_barang',$data);
	}
}

?>