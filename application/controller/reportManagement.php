<?php 
class reportManagement extends Application
{
    function __construct()
    {
		$this->loadModel("modelReportManagement");
		$this->loadModel("modelForm");
    }
	function index(){
		$data["aksinya"] = "view";
		$data["report"] = $this->modelReportManagement->showAllReport();
		$this->loadView("reportManagement",$data);
	}
	function tambah(){
		$data['aksinya'] = 'viewForm';
		$data['act'] = 'tambahReport';
		$data['listForm'] = $this->modelForm->showForm();
    	$this->loadView("reportManagement",$data);
	}
	function loadKolom($param){
		$id_form = $param[0];
		$id_report = $param[1];
		$data['detail_form']= $this->modelForm->renderForm($id_form);
		$data['detail_field'] = $data['detail_form']['detail_field'];
		//var_dump($data['detail_field']);
		$data['detail_field'] = $this->modelReportManagement->pecahKolom($data['detail_field']);
		if($id_report != NULL){
			$data['detail_kolom'] = $this->modelReportManagement->detailReportKolom($id_report);
		}
		//var_dump($data['detail_kolom']);
		$this->loadView("reportManagementKolom",$data);
	}
	function tambahReport(){
		//Menambahkan Ke Tabel Report
		$id_laporan = $this->modelReportManagement->inputReport($_POST);
		if($id_laporan != NULL || $id_laporan != 0 ){
		$status_input = $this->modelReportManagement->inputKolomReport($_POST['kolom'] , $_POST['field_judul'] , $_POST['opsi'],$id_laporan);
		}else{
			$status_input = false;
		}
		if($status_input){
			$this->redir('reportManagement','','','Anda Berhasil Menambahkan Report');
		}else{
			$this->redir('reportManagement','','','Terjadi Kesalahan waktu menambahkan Report , \nReport Tidak ditambahkan');
		}
	}
	function delete($param){
		$status_laporan = $this->modelReportManagement->deleteTabelReport($param[0]);
		if($status_laporan){
			$status_kolom = $this->modelReportManagement->deleteKolomReport($param[0]);
			if($status_kolom){
				$this->redir('reportManagement','','','Report Berhasil Dihapus');		
			}else{
				$this->redir('reportManagement','','','Terjadi Kesalahan waktu menghapus Kolom Report , \nReport Tidak dihapus');	
			}
		}else{
			$this->redir('reportManagement','','','Terjadi Kesalahan waktu menghapus Report , \nReport Tidak dihapus');
		}
	}
	function edit($param){
		$id_report = $param[0];
		$data['aksinya'] = 'viewForm';
		$data['act'] = 'editReport';
		$data['listForm'] = $this->modelForm->showForm();
		$data['detail_report'] = $this->modelReportManagement->detailReportData($id_report);
		$data['detail_report'] = $data['detail_report'][0];
    	$this->loadView("reportManagement",$data);
	}
	function editReport($param){
		$id_report = $param[0];
		// Pertama Edit Dulu Form - Formnya 
		$status_update = $this->modelReportManagement->editReport($_POST,$id_report);
		if($status_update !=NULL || $status_update !=0){
			// Kedua Hapus Semua kolom yang ada di database dan insertkan yang baru
			$status_kolom = $this->modelReportManagement->deleteKolomReport($id_report);
			$status_input = $this->modelReportManagement->inputKolomReport($_POST['kolom'] , $_POST['field_judul'] , $_POST['opsi'],$id_report);
			if($status_input && $status_kolom){
				$this->redir('reportManagement','','','Report Berhasil Diperbaharui');
			}else{
				$this->redir('reportManagement','','','Terjadi Kesalahan waktu Mengupdate Kolom Report , \nReport Tidak Berubah');
			}
		}else{
			$this->redir('reportManagement','','','Terjadi Kesalahan waktu Mengupdate Report , \nReport Tidak Berubah');
		}
	}
}
?>