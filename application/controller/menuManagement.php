<?php 
class menuManagement extends Application
{
    function __construct()
    {
		$this->loadModel("modelForm");        
		$this->loadModel("modelReportManagement");
		$this->loadModel("modelMenu");
    }
	function index(){
		$data['act'] = "view_data";
		$data['dataMenu'] = $this->modelMenu->getListMenu();
		$this->loadView("menuManagement",$data);
	}
	function insertData(){
		$data['act'] = "view_form";
		$this->loadView("menuManagement",$data);
	}
	function edit($param){
		$data['act'] = "view_form";
		$data['aksi'] = 'editDataMenu';
		$data['detail_menu']=$this->modelMenu->getDetailMenu($param[0]);
		$data['id_menu'] = $data['detail_menu']['id_menu'];
		$this->loadView("menuManagement",$data);
	}
	function insertDataMenu(){
		$hasil = $this->modelMenu->insertMenu($_POST);
		if($hasil){
			$this->redir("menuManagement","","","Menu Berhasil Ditambahkan");
		}else{
			$this->redir("menuManagement","","","Mohon Maaf , Ada kesalahan dalam menginputkan menu \nMEnu Tidak ditambahkan");
		}
	}
	function editDataMenu($param){
		$hasil = $this->modelMenu->editMenu($_POST,$param[0]);
		if($hasil){
			$this->redir("menuManagement","","","Menu Berhasil diedit");
		}else{
			$this->redir("menuManagement","","","Mohon Maaf , Ada kesalahan dalam Pengeditan menu \nMEnu Tidak berubah");
		}
	}
	function deleteMenu($param){
		$hasil = $this->modelMenu->deleteMenu($param[0]);
		if($hasil){
			$this->redir("menuManagement","","","Menu Berhasil dihapus");
		}else{
			$this->redir("menuManagement","","","Terjadi Kesalahan \nMenu tidak dapat Dihapus");
		}
	}
	function listOpsi($param){
		$data['pilihan'] = $param[0];
		$data['id_pilihan'] = $param[1];
		if($data['pilihan']=="form"){
			$data['form'] = $this->modelForm->showForm();
		}else{
			$data['report'] = $this->modelReportManagement->showAllReport();
		}
		$this->loadView("menuManagementList",$data);
	}
}
?>