<?php 
class user extends Application
{
    function __construct()
    {
        $this->loadModel("modelRole");
        $this->loadModel("modelUser");
    }

    function index()
    {
		$data['act'] = "view_data";
		$data['user'] = $this->modelUser->loadUser();
        $this->loadView('user',$data);
    }
	function insert(){
		$data['act'] = "form";
		$data['role'] = $this->modelRole->loadRole();
        $this->loadView('user',$data);
	}
	function insertData(){
		unset($_POST['oldpassword']);
		$hasil = $this->modelUser->insertUser($_POST);
		if($hasil){
			$this->redir('user','','','User Telah Ditambahkan');
		}else{
			$this->redir('user','','','Terjadi Kesalahan saat menambahkan User ,\nUser tidak ditambahkan');
		}
	}
	function edit($param){
		$data['act'] = "form";
		$data['aksi'] = 'editData';
		$data['role'] = $this->modelRole->loadRole();
		$data['detail_user'] = $this->modelUser->loadUserDetail($param[0]);
        $this->loadView('user',$data);
	}
	function editData($param){
		if($_POST['password'] == $_POST['oldpassword']){
			unset($_POST['password']);
		}else{
			$_POST['password'] = md5($_POST['password']);
		}
		unset($_POST['oldpassword']);
		$update= $this->modelUser->editUser($param[0],$_POST);
		if($update){
			$this->redir('user','','','User Telah Diedit');
		}else{
			$this->redir('user','','','Terjadi Kesalahan saat Mengedit User ,\nUser tidak diedit');
		}
	}

	function deleteUser($param){
		$delete = $this->modelUser->deleteUser($param[0]);
		if($delete){
			$this->redir('user','','','User Telah Dihapus');
		}else{
			$this->redir('user','','','Terjadi Kesalahan saat Menghapus User ,\nKemungkinan User Sudah dihapus ');
		}
	}
	function userProfil(){
		$data['detail_user'] = $this->modelUser->loadUserDetail($_SESSION['user_detail']['id_user']);
        $this->loadView('userProfile',$data);
	}
	function userProfilEdit($param){
		if($_POST['password'] == $_POST['oldpassword']){
			unset($_POST['password']);
		}else{
			$_POST['password'] = md5($_POST['password']);
		}
		unset($_POST['oldpassword']);
		$update= $this->modelUser->editUser($param[0],$_POST);
		if($update){
			$this->redir('user','userProfil/','','User Telah Diedit \nSiliahkan Login dengan Akun baru untuk memulai Sesi kembali');
		}else{
			$this->redir('user','userProfil/','','User tidak diedit dikarenakan Form tidak berubah');
		}
	}
}
?>