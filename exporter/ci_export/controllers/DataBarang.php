<?php
class databarang extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('modeldatabarang_crud');
	}
	function index(){
		$data['data_tabel']=$this->modeldatabarang_crud->m_lihat();
		$this->load->view('databarang_v_lihat',$data);
	}
	function tambah(){
		$this->load->view('databarang_v_tambah');
	}
	function tambah_act(){
		$data=array(
				"id"=> $this->input->post("id"),"namabarang1"=> $this->input->post("namabarang1"),"jumlah2"=> $this->input->post("jumlah2")
			);
			
		$this->modeldatabarang_crud->m_tambah_act($data);	
		redirect(base_url().'index.php/databarang/');
	}
	function hapus($id){
		$data=array(
			'id' => $id
			);
		$this->modeldatabarang_crud->m_hapus($data);
		redirect(base_url().'index.php/databarang/');
	}
	function edit($id){
		$data=array(
			'id' => $id
			);
		$data['data_edit']=$this->modeldatabarang_crud->m_edit($data);
		$this->load->view('databarang_v_edit',$data);
	}	
	function update($id){
		//$id = $this->input->post('id');

		$data=array(			
			"id"=> $this->input->post("id"),"namabarang1"=> $this->input->post("namabarang1"),"jumlah2"=> $this->input->post("jumlah2"),
			"id"=>$id
			);
		$this->modeldatabarang_crud->m_update($data,$id);
		redirect(base_url().'index.php/databarang/');
	}
	
}