<?php
class {controler} extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('{model}_crud');
	}
	function index(){
		$data['data_tabel']=$this->{model}_crud->m_lihat();
		$this->load->view('{controler}_v_lihat',$data);
	}
	function tambah(){
		$this->load->view('{controler}_v_tambah');
	}
	function tambah_act(){
		$data=array(
				{isi_kolom}
			);
			
		$this->{model}_crud->m_tambah_act($data);	
		redirect(base_url().'{url}{controler}/');
	}
	function hapus($id){
		$data=array(
			'id' => $id
			);
		$this->{model}_crud->m_hapus($data);
		redirect(base_url().'{url}{controler}/');
	}
	function edit($id){
		$data=array(
			'id' => $id
			);
		$data['data_edit']=$this->{model}_crud->m_edit($data);
		$this->load->view('{controler}_v_edit',$data);
	}	
	function update($id){
		//$id = $this->input->post('id');

		$data=array(			
			{isi_kolom},
			"id"=>$id
			);
		$this->{model}_crud->m_update($data,$id);
		redirect(base_url().'{url}{controler}/');
	}
	
}