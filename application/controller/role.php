<?php
class role extends Application
{
    function __construct()
    {
    	$this->loadModel("modelRole");
		$this->loadModel("modelMenu");
    }
	
    function index()
    {
		$data['dataRole'] = $this->modelRole->loadRole();
		$data['act'] = 'view_data';
        $this->loadView('role',$data);
    }
	function loadMenu($param){
		$this->loadExt("plugin");
		$data['plugin'] = new plugin();
		$data['id_role'] = $param[0];
		$data['menu'] = $this->modelMenu->getListMenu();
		$data['detailRole'] = $this->modelRole->detailRole($param[0]);
		$data['menuRole'] = $this->modelMenu->getMenu($param[0]);
		$this->loadView("roleMenu",$data);
	}
	function roleEdit($param){
		$id_role = $param[0];
		$this->modelRole->deleteForbiden($id_role);
		foreach($_POST as $id_menu){
			$insert = $this->modelRole->insertForbiden($id_role , $id_menu);
		}
		if($insert){
			$this->redir("role","","","Role Berhasil Disimpan");
		}else{
			$this->redir("role","","","Role Gagal Disimpan");
		}
	}
	function insert(){
		$data['act'] = 'view_form';
        $this->loadView('role',$data);
	}
	function insertRole(){
		$insert = $this->modelRole->insertRole($_POST['nama_role']);
		if($insert){
			$this->redir("role","","","Role Berhasil Disimpan");
		}else{
			$this->redir("role","","","Role Gagal Disimpan");
		}
	}
	function edit($param){
		$data['detailRole'] = $this->modelRole->detailRole($param[0]);		
		$data['act'] = 'view_form';
		$data['aksi'] = 'editData';
        $this->loadView('role',$data);
	}
	function editData($param){
		$edit = $this->modelRole->editRole($_POST['nama_role'],$param[0]);
		if($edit){
			$this->redir("role","","","Role Berhasil Disimpan");
		}else{
			$this->redir("role","","","Role Gagal Disimpan");
		}
	}
	function deleteRole($param){
		$this->modelRole->deleteForbiden($param[0]);
		$delete = $this->modelRole->deleteRole($param[0]);
		if($delete ){
			$this->redir("role","","","Role Berhasil Dihapus");
		}else{
			$this->redir("role","","","Role Gagal Dihapus");
		}
	}
}
?>