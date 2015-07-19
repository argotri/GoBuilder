<?php
class report extends Application
{
    function __construct()
    {
     	$this->loadModel("modelReportManagement");   
    }
    function index()
    {
        $this->redirect("home");
    }
	function view($param){
		$id_report = $param[0];
		$data['print'] = $param[1];
		$data['id_report'] = $id_report;
		$data['detail_report'] = $this->modelReportManagement->detailReportData($id_report);
		$data['detail_report'] = $data['detail_report'][0];
		$data['kolom_report'] = $this->modelReportManagement->detailReportKolom($id_report);
		$data['isi_report'] = $this->modelReportManagement->getIsiReport($data['detail_report']['nama_tabel'] ,$data['kolom_report'] ,$_GET['filter']);
		$this->loadView("report",$data);
	}

}
?>