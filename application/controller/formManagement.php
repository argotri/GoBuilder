<?php
class formManagement extends Application
{
    function __construct()
    {
     	$this->loadModel(modelForm);
    }

    function index(){
		$data['listform'] =$this->modelForm->showForm();
    	$this->loadView("formManagement",$data);
    }
    function edit($param) {
    	$data['aksinya'] = 'edit';
    	$this->loadView("formManagement",$data);
    }
    function tambah() {
    	$data['aksinya'] = 'tambah';
    	$this->loadView("formManagement",$data);
    }
	function tambahField($var){
		$data['id'] = $var[0];
		$this->loadView("fieldAdd",$data);
	}
	function propertyField($var){
		$data['id'] = $var[0];
		$data['tipe']=$var[1];
		$data['listForm'] = $this->modelForm->showForm();
		$this->loadView("fieldProperty",$data);
	}
	function propertyForm($param){
		$id_form = $param[0];
		$id_field = $param[1];
		$field = $this->modelForm->renderFormByTable($id_form);
		$field = $field["detail_field"];
		for($i=1;$i<count($field);$i++){
			$result[$i]['kolom'] = $field[$i]['Field'];
			$result[$i]['nama_label'] = explode(",",$field[$i]['Comment']);
			$result[$i]['nama_label'] = $result[$i]['nama_label'][0];
		}
	//	$this->loadExt("plugin");
		$plg = new plugin();
		echo $plg->encode_json($result);
		///// Butuh Solusi //////////
		//// 
		//$this->loadView("fieldProperty",$data);
	}
	function tambahForm(){
		$field = $_POST['field'];
		$data['form'] = $this->modelForm->BuatForm($_POST['judul_form'], AWALAN_FORM.$this->normalisasiText(uniqid()),$field);
		$this->loadView("formTambah",$data);
	}
	function delete($id) {
		$data['status_hapus'] = $this->modelForm->deleteForm($id[0]);
		//var_dump($data);
		/*
		if($data['status_hapus']==true){
			$this->redir('formManagement','','');	
		}*/
		$this->loadView("formManagement",$data);
	}
	function export($var){
		$id_form = $var[0];
		$form_detail = $this->modelForm->formDetail($id_form);
		$data["form"] = $form_detail[0];
		$this->loadView("export",$data);
	}
	function exportForm(){
		$path = $this->modelForm->copy_exporter($_POST[tipe]);
		$this->modelForm->generate($path,$_POST['tipe'],$_POST);
	}
}
?>