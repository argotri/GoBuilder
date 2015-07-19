<?php
class  form extends CI_Controller {
			function __construct()
				{
					parent::__construct();
					$this->load->model(modelForm);
				}
			function index(){
				$this->redir("home");
			}
			function view($param) {
				$data['form'] = $this->modelForm->renderForm($param[0]);
				$data["act"] = "view_form";
				$data["id_form"] = $param[0];
				if($param[1] != NULL){
					$data["data_form"] = $this->modelForm->getDetail($data['form']['detail_form']['nama_tabel'],$param[1]);
					$data['aksi'] = "editData";
					$data['id_data'] = $param[1];
				}
				$this->loadView("form",$data);
			}
			
			/* Dijelaskan Get Field Nya Pada Bab 4 */
			
			function getField($field_detail,$value) {
				$data['field'] = $field_detail;
				list($data['text'],$data['tipe'],$data['other']) = explode(",", $field_detail['Comment'],3);
				//$data = $this->getData($field_detail);
				$data['tipe'] = trim($data['tipe']);
				switch($data['tipe']){
					case "text":
					return $this->modelForm->renderText($data,$value);
					break;
					case "text_area":
					return $this->modelForm->renderTextArea($data,$value);
					break;
					case "number":
					return $this->modelForm->renderNumber($data,$value);
					break;
					case "select":
					return $this->modelForm->renderSelect($data,$value);
					break;
					case "date":
					return $this->modelForm->renderDate($data,$value);
					break;
					case "file":
					return $this->modelForm->renderFile($data,$value);
					break;
					case "bool":
					return $this->modelForm->renderBool($data,$value);
					break;
					case "check":
					return $this->modelForm->renderCheck($data,$value);
					break;
				}
			}
			/* End Dijelaskan */
			
			
			function getData($field_detail){
				$data = $field_detail;
				list($data['text'],$data['tipe'],$data['other']) = explode(",", $field_detail['Comment'],3);
				return $data;
			}
			function insertData($param){
				$data['form'] = $this->modelForm->renderForm($param[0]);
				$field = $data['form']['detail_field'];
				/////////////// Digunakan Untuk mengecek field yang memerlukan suatu perhatian khusus
				for($i=1;$i<=count($field);$i++){
					if(strpos($field[$i]['Comment'],"file")){
						$_POST[$field[$i]['Field']] = $this->upload($field[$i]['Field']); // Melakukan Upload dan menyimpan nama yang baru 
					}
					if(strpos($field[$i]['Comment'],"check")){
						
						$_POST[$field[$i]['Field']] = implode(" , ",$_POST[$field[$i]['Field']]);
					}
				}
				////////////// End Upload File
				$data["insert"] = $this->modelForm->insertForm($param[0] , $_POST); // Param yang ke 0 adalah IDnya
				$data["id_form"] = $param[0];
				$this->loadView("form",$data);
			}
			function upload($field){
				$name = $_POST[$field."-old"];
				if($_FILES[$field]["error"] == UPLOAD_ERR_OK){
					$tmp_name = $_FILES[$field]["tmp_name"];
					$name = UPLOAD_FOLDER.uniqid()."-".$_FILES[$field]["name"];
					move_uploaded_file($tmp_name,$name);
				}
				return $name;
			}
			function editData($param){
				$data['form'] = $this->modelForm->renderForm($param[0]);
				$field = $data['form']['detail_field'];
				/////////////// Digunakan Untuk mengecek tipe field apabila ada aksi tambahan
				for($i=1;$i<=count($field);$i++){
					if(strpos($field[$i]['Comment'],"file")){
						$_POST[$field[$i]['Field']] = $this->upload($field[$i]['Field']); // Melakukan Upload dan menyimpan nama yang baru 
						unset($_POST[$field[$i]['Field']."-old"]);
					}
					if(strpos($field[$i]['Comment'],"bool")){
						if($_POST[$field[$i]['Field']] == NULL){
							$_POST[$field[$i]['Field']] = 0;
						}
					}
					if(strpos($field[$i]['Comment'],"check")){
						if(count($_POST[$field[$i]['Field']]) > 0 ){
							$_POST[$field[$i]['Field']] = implode(" , ",$_POST[$field[$i]['Field']]);
						}else{
							$_POST[$field[$i]['Field']] = "-";
						}
					}
				}
				$data["editData"] = $this->modelForm->editForm($param[0], $param[1], $_POST); // Param yang ke 0 adalah IDnya
				////////////// End Upload File
				if($data["editData"] == false){
					$data["editData"] = 'tidak_berubah';
				}
				$data["id_form"] = $param[0];
				$this->loadView("form",$data);
			}
			function hapusData($param){
				$data['form'] = $this->modelForm->renderForm($param[0]);
				$data['hapusData'] = $this->modelForm->deleteData($param[0] , $param[1]);
				if($data["hapusData"] == false){
					$data["hapusData"] = 'tidak_dihapus';
				}
				$data["id_form"] = $param[0];
				$this->loadView("form",$data);
			}
			function viewData($param){
				$data['form'] = $this->modelForm->renderForm($param[0]);
				$data["act"] = "view_data";
				for($i=1;$i<count($data["form"]["detail_field"]);$i++){
					$data["header_tabel"][$i] = $this->getData($data["form"]["detail_field"][$i]);
				}
				$data["id_form"] = $param[0];
				//$data["field_detail"] = $this->getData();
				$this->loadView("form",$data);
			}
			function viewDataAjax($param){
				$form = $this->modelForm->renderForm($param[0]);
				$field = $form['detail_field'];
				//Mulai Membentuk Kolomnya
				$this->loadExt("ssp.class");
				$kolom = array();
				//echo count($field);
				$i=0;
				for($i=0;$i<count($field);$i++){
					list($label , $tipe , $other1 ,$nama_tabel , $fff) = explode(",",$field[$i]['Comment'],5);
					$kolom[$i]['tipe'] = trim($tipe);
					/////////////// Digunakan untuk memecah comment menjadi sesuatu yang mudah dibaca
					$kolom[$i]["db"] = $field[$i]["Field"];
					if($i==0){//untuk menyembunyikan ID
						$kolom[$i]["dt"] = MAX_NUMBER;
					}else{
						$kolom[$i]["dt"] = ($i-1);
					}

					if(strpos($field[$i]['Comment'],"select") &&  strpos($field[$i]['Comment'],"dimamis")){
						$kolom[$i]['join']['table'] = $nama_tabel;
						$kolom[$i]['join']['field'] = $fff;
					}
				}
				//echo $i;
				//var_dump($kolom);
				//simple ( $request,  $table, $primaryKey = 'id', $columns,$db )
				///// 
				/*
					nanti parameter $tabel diganti sama Join juga bisa ya , jika select nya itu lebih dari 1 maka akan dijoinkan secara otomatis , TQ
				
				*/
				
				
				///////////////////////// Jangan lupa dibuka /////////////////////
				//simple ( $request,  $table, $primaryKey = 'id', $columns,$db ,$uhome)
				echo json_encode(SSP::simple($_GET,$form["detail_form"]["nama_tabel"],"",$kolom,$this->modelForm->getDB(),$this->url()));

			}

}
        