<?php
class  modelForm extends CI_Controller {
			private  $namaForm;
			private $JumlahField;
			private $namaTabel;
			
			function __construct()
				{
					$this->loadProduct("database_selector");
					$this->db = $this->database_selector->PilihDatabase();
				}
			function BuatForm($namaForm, $namaTabel , $field){
//				var_dump($field);
				$this->namaForm = $namaForm;
				$this->namaTabel = $namaTabel;
				
				////////////////// Digunakan apakah ada joinan atau tidak , nanti data join diinsertkan disini
				$tabel2 = array();
				$i=0;
				foreach($field as $f){
					//var_dump($f);
					$tipe = trim($f['tipe']); // MEnghapus spasi jika ada
					if($tipe=="select"){ /// Memilih select apabila ada
						if($f['tipe_select'] == "dinamis"){
							$tabel2[$i]['nama_tabel'] = $f['nama_tabel'];
							$tabel2[$i]['field'] = $f['nama_value'];
							$i++;
						}
					}
				}
				//var_dump($tabel2);
				if(count($tabel2) > 0){
					$tabel = $this->namaTabel;
					//foreach($tabel2 as $tbl){
						//$tabel .= " LEFT JOIN ".$tbl['nama_tabel']." ON ".$this->namaTabel.".".$tbl['field']." = ".$tbl['nama_tabel'].".id";
					//	$tabel .= ",".$tbl['nama_tabel'];
					//}
				}
				//echo $tabel;
				if($tabel != ""){
					$result = $this->insertTabelForm($tabel);
				}else{
					$result = $this->insertTabelForm();
				}
				// jika benar maka langsung membuat tabel
				if($this->db->createTabel($this->namaTabel , $field)==0){
					return true; 
				} else {
					return false;
				}
			}
			private function insertTabelForm($n_tabel = "") {
				/// Digunakan Untuk insert ke tabel form
				$isi['nama_form'] = $this->namaForm;
				if($n_tabel == ""){ // Mengecek apakah singel tabel atau dual table
					//  Single tabel
					$isi['nama_tabel'] = $this->namaTabel;
				}else{
					// Join lebih dari 1 tabel
					$isi['nama_tabel'] = $n_tabel;
				}
				$isi['user_create'] = $_SESSION['username'];
				return $this->db->insert('form',$isi);
			}
			// Digunakan untuk list all form
			function showForm(){
				return  $this->db->select("form","","nama_form ASC");
			}
			function formDetail($id_form) {
				return  $this->db->select("form"," id_form = ".$id_form,"nama_form ASC");
			}
			function deleteForm($id_form) {
				$form_detail = $this->formDetail($id_form);
				// Menghapus Isi form dari tabel Form 
				if($this->db->deleteTabel($form_detail[0]['nama_tabel']) == 0){
					$this->db->delete("form"," id_form = ".$form_detail[0]['id_form']);
					return true;
				}else{
					//echo "Ini Tidak Dijalankan Bossss";
					return false;
				}
			}
			
			// Digunakan untuk mereturn Field - field dari form tersebut
			function renderForm($id_form) {
				// Ambil Data dari Database
				$detail_form = $this->db->select("form" ," id_form = ".$id_form , "");
				$detail_field = $this->db->lihat_semua_kolom($detail_form[0]['nama_tabel']);
				$data['detail_form'] = $detail_form[0];
				$data['detail_field'] = $detail_field;
				return $data;
			}
			// Digunakan untuk mereturn Field - field dari form tersebut
			function renderFormByTable($nama_tabel) {
				// Ambil Data dari Database
//				$detail_form = $this->db->select("form" ," nama_form = ".$id_form , "");
				$detail_field = $this->db->lihat_semua_kolom($nama_tabel);
				$data['detail_form'] = $detail_form[0];
				$data['detail_field'] = $detail_field;
				return $data;
			}
			function renderText($data,$value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<input type="text" class="form-control" '.$required.' name="'.$data[field][Field].'" value="'.$value.'">
				<p class="help-block"></p>
				</div>
				';
			}
			function renderFile($data,$value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				if($value != NULL){
					$download = '<a href="'.$this->Url().$value.'" target="_blank">Download file</a>';
					$download .= '<input type="hidden" name="'.$data[field][Field].'-old" value="'.$value.'">';
				}
				$restricted = $data['other'];
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<input type="file" placeholder="Upload a File" accept="'.$restricted.'" '.$required.' name="'.$data[field][Field].'" >
				<p class="help-block">'.$download.'</p>
				</div>
				';
			}
			function renderDate($data,$value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<input type="text" class="form-control tanggal" '.$required.' name="'.$data[field][Field].'" value="'.$value.'">
				<p class="help-block"></p>
				</div>
				';
			}
			function renderNumber($data, $value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<input type="number" class="form-control" '.$required.' name="'.$data[field][Field].'" value="'.$value.'">
				<p class="help-block"></p>
				</div>
				';
			}
			function renderBool($data, $value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				if($value == 1){
					$chechked = "checked";
				}
				return '
				<div class="checkbox">
				<label>
				<input type="checkbox"  name="'.$data[field][Field].'" value="1" '.$chechked.'>
				'.$data[text].'
				</label>
				<p class="help-block">*Jika Benar , Maka Silahkan Centang</p>
				</div>
				';
			}
			function renderCheck($data, $value){
				$cek = trim($data["other"]);
				$cek = explode("|",$cek);
				$value = explode(",",trim($value));
				$i=0;
				/////// Trimming Every data
				if(is_array($value)){
					foreach($value as $v){
						$tmp[$i++]= trim($v);
					}
				}
				$value = $tmp;
				///////// End
				$i=0;
				foreach($cek as $c){
				if(in_array($c,$value)){
					$chechked = "checked";
				}else{
					$chechked = "";
				}
				$ret_cek .= '<div class="checkbox">
				<label>
				<input type="checkbox"  name="'.$data[field][Field].'['.$i++.']" value="'.$c.'" '.$chechked.'>
				'.$c.'
				</label>
				</div>';
				}
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				'.
					$ret_cek
				.
				'
				</div>
				';
			}
			function renderTextArea($data , $value){
				if($data['field']['Null'] == 'NO'){
					$required = "required='required'";
				}
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<textarea class="form-control" '.$required.' name="'.$data[field][Field].'">'.$value.'</textarea>
				<p class="help-block"></p>
				</div>
				';
			}
			
			function renderSelect($data, $value){
				/*
				echo "<pre>";
				var_dump($data);
				echo "</pre>";*/
				list($statis , $nilai) = explode(',',$data['other'],2);				
				$statis = trim($statis);
				if($statis == "statis"){ // Mengecek statis atau bukan
					$nilai = explode("|",$nilai);
					foreach($nilai as $n){ // Looping opsi buat statis
						if($n == $value){ // Mengecek value pas editnya nanti
							$selected = "selected";
						}else{
							$selected = "";
						}
						$isi_select .= '<option value="'.$n.'" '.$selected.'>'.$n.' </option>';
					}
				}else{
					list($tabel , $kolom) = explode(",",$nilai,2);
					$kolom = trim($kolom);
					$ds = $this->db->select($tabel);
					foreach($ds as $dt){
						if($dt['id'] == $value){
							$selected = "selected";
						}else{
							$selected = "";
						}
						$isi_select .= '<option value="'.$dt['id'].'" '.$selected.'>'.$dt[$kolom].' </option>';
					}
					//var_dump($data);
				}
				
				return '
				<div class="form-group">
				<label>'.$data[text].'</label>
				<select name="'.$data['field']['Field'].'" class="form-control" >
					'.$isi_select.'
				</select>
				<p class="help-block"></p>
				</div>
				';
				
			}
			
			// End Pembuatan Field
			
			/* Digunakan Untuk melakukan CRUD terhadap Datanya Form */
			function insertForm($id_form , $data_form){
				$tabel = $this->formDetail($id_form);
				$tabel = $tabel[0]["nama_tabel"];
				return $this->db->insert($tabel,$data_form);
			}
			function editForm($id_form ,$key , $data_form){
				//var_dump($data_form);
				$tabel = $this->formDetail($id_form);
				$tabel = $tabel[0]["nama_tabel"];
				$key = " id = ".$key;
				return $this->db->edit($tabel,$key,$data_form);
			}
			function deleteData($id_form , $key){
				$tabel = $this->formDetail($id_form);
				$tabel = $tabel[0]["nama_tabel"];
				$key = " id = ".$key;
				return $this->db->delete($tabel,$key);
			}
			function getDB(){
				return $this->db->getDBObject();
			}
			function getDetail($tabel , $id_form){
				$data =  $this->db->select($tabel," id = ".$id_form);
				return $data[0];
			}
			
			/*
				Digunakan Untuk mengexport
			*/
			function copy_exporter($tipe){
				$this->loadExt("plugin");
				$plugin = new plugin();
				switch(strtolower($tipe)){
					case "ci":
					$plugin->recursiveRemoveDirectory("exporter/ci_export");
					$plugin->recurse_copy("exporter/ci","exporter/ci_export");
					return "exporter/ci_export";
					break;
				}
			}
			function generate($path,$tipe,$data){
				switch(strtolower($tipe)){
					case "ci":
					return $this->rename_ci($path,$data);
					break;
				}
			}
			function rename_ci($path,$data){
				///// Membaca Data
				$file_controler = file_get_contents($path."/controllers/crud.php");
				/////// Rename Controler
				$file_controler = str_replace("{controler}",strtolower($data['controler']),$file_controler);
				$file_controler = str_replace("{model}",strtolower($data['model']),$file_controler);
				$file_controler = str_replace("{url}",strtolower($data['url']),$file_controler);
				$form = 
				//echo $file_controler;
				/////// End Rename Controler
				////// Save Controler
				file_put_contents($path.'/controllers/'.ucfirst($data['controler']).".php", $file_controler);
				unlink($path."/controllers/crud.php");	
			}
			function renderExportForm($id_form){
				
			}
}