<?php
class  modelForm extends Application {
			private  $namaForm;
			private $JumlahField;
			private $namaTabel;
			
			function __construct()
				{
					$this->loadProduct("database_selector");
					$this->db = $this->database_selector->PilihDatabase();
					$this->loadExt("plugin");
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
			//	$this->loadExt("plugin");
				$plugin = new plugin();
				switch(strtolower($tipe)){
					case "ci":
					$plugin->recursiveRemoveDirectory("exporter/ci_export");

					$plugin->recurse_copy("exporter/ci","exporter/ci_export");
					return "exporter/ci_export";
					break;
					case "html":
					$plugin->recursiveRemoveDirectory("exporter/html_export");

					$plugin->recurse_copy("exporter/html","exporter/html_export");
					return "exporter/html_export";
					break;
					case "yii":
					$plugin->recursiveRemoveDirectory("exporter/yii_export");

					$plugin->recurse_copy("exporter/yii","exporter/yii_export");
					return "exporter/yii_export";
					break;
				}
			}
			function generate($path,$tipe,$data){
				switch(strtolower($tipe)){
					case "ci":
					$this->rename_ci_controler($path,$data);
					$this->rename_ci_model($path,$data);
					$this->rename_ci_view_lihat($path,$data);
					$this->rename_ci_view_tambah($path,$data);
					$this->rename_ci_view_edit($path,$data);
					$this->exportTabel($path,$data);
					$this->zip_download($path,$data);
					break;
					case 'yii':
					$this->rename_yii_controler($path,$data);
					$this->rename_yii_model($path , $data);
					$this->copy_file_view_yii($path,$data);
					$this->rename_yii_views_form($path , $data);
					$this->rename_yii_views_view($path,$data);
					$this->rename_yii_views_admin($path,$data);
					$this->rename_yii_views_create($path,$data);
					$this->rename_yii_views_index($path,$data);
					$this->rename_yii_views_update($path,$data);
					$this->rename_yii_views_viewv($path,$data);
					$this->exportTabel($path,$data);
					$this->zip_download_yii($path,$data);
					break;
					case "html":
					$this->rename_html_controler($path,$data);
					$this->rename_html_model($path , $data);
					$this->rename_html_c($path,$data);
					$this->rename_html_view_tambah($path,$data);
					$this->rename_html_view_edit($path,$data);
					$this->exportTabel($path,$data);
					$this->zip_download($path,$data);
					break;
				}
			}

			///////////////////////////////////////////// Start Exporter CI
			function rename_ci_controler($path,$data){
				if($data['base_url'] != NULL){
					$data['base_url'] .="/";
				}
				///// Membaca Data
				$file_controler = file_get_contents($path."/controllers/crud.php");
				/////// Rename Controler
				$file_controler = str_replace("{controler}",strtolower($data['controler']),$file_controler);
				$file_controler = str_replace("{model}",strtolower($data['model']),$file_controler);
				$file_controler = str_replace("{url}",strtolower($data['base_url']),$file_controler);
				/// Get Column
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				foreach ($kolom_form as $key => $v) {
					$form .= addslashes('"'.$v['Field'].'"=> $this->input->post("'.$v['Field'].'"),');
				}
				$form = stripslashes ($form);
				$form = rtrim($form, ",");
				$file_controler = str_replace("{isi_kolom}",$form,$file_controler);
				//echo $file_controler;
				/////// End Rename Controler
				////// Save Controler
				file_put_contents($path.'/controllers/'.ucfirst($data['controler']).".php", $file_controler);
				unlink($path."/controllers/crud.php");	
			}
			function rename_ci_model($path,$data){
				///// Membaca Data
				$file_model = file_get_contents($path."/models/m_crud.php");
				/////// Rename Controler
				$file_model = str_replace("{model_firstBig}",ucfirst($data['model']),$file_model);
				$file_model = str_replace("{tabel}",ucfirst($data['tabel']),$file_model);
				//echo $file_controler;
				/////// End Rename Controler
				////// Save Controler
				file_put_contents($path.'/models/'.ucfirst($data['model'])."_crud.php", $file_model);
				unlink($path."/models/m_crud.php");	
			}
			function rename_ci_view_lihat($path,$data){
				$file_view = file_get_contents($path."/views/v_lihat.php");
				if($data['base_url'] != NULL){
						$data['base_url'] .= "/";
				}
				$form_detail = $this-> formDetail($data['id_form']);
				///////////////// Mengubah Title
				$file_view = str_replace("{title}", $form_detail['nama_form'], $file_view);
				///////////////// Mengubah Base URL
				$file_view = str_replace("{base_url}", $data['base_url'], $file_view);
				///////////////// Mengubah Controler
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				///////////////// Mengubah Header Tabel
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				//var_dump($kolom_form);
				foreach ($kolom_form as $key => $v) {
					if($v['Comment']!=NULL){
						$temp = explode(",", $v['Comment']);
						$header .= '<th>'.$temp[0].'</th>';	
					}else{
						$header .= '<th>'.$v['Field'].'</th>';	
					}
					
					$isi .=  '<td><?php echo $lihat->'.$v['Field'].';?></td>';
				}
				$file_view = str_replace("{kolom_header}", $header, $file_view);

				$file_view = str_replace("{kolom_isi}", $isi, $file_view);

				file_put_contents($path.'/views/'.ucfirst($data['controler'])."_v_lihat.php", $file_view);
				unlink($path."/views/v_lihat.php");	
			}
			function rename_ci_view_tambah($path,$data){
				$file_view = file_get_contents($path."/views/v_tambah.php");
				$form = $this->renderForm($data['id_form']);
				if($data['base_url'] != NULL){
						$data['base_url'] .= "/";
				}
				///////////////// Mengubah Title base url dan controler
				$file_view = str_replace("{base_url}", $data['base_url'], $file_view);
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				$file_view = str_replace("{title}", $form['detail_form']['nama_form'], $file_view);
				foreach($form['detail_field'] as $dataField){ 
					$isi_form .= $this->getField($dataField,$data_form[$dataField['Field']]).PHP_EOL;
				}
				$file_view = str_replace("{isi_form}", $isi_form, $file_view);
				file_put_contents($path.'/views/'.strtolower($data['controler'])."_v_tambah.php", $file_view);
				unlink($path."/views/v_tambah.php");	
			}
			function rename_ci_view_edit($path,$data){
				$file_view = file_get_contents($path."/views/v_edit.php");
				$form = $this->renderForm($data['id_form']);
				if($data['base_url'] != NULL){
						$data['base_url'] .= "/";
				}
				///////////////// Mengubah Title base url dan controler
				$file_view = str_replace("{base_url}", $data['base_url'], $file_view);
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				$file_view = str_replace("{title}", $form['detail_form']['nama_form'], $file_view);
				foreach($form['detail_field'] as $dataField){ 
					$isi_form .= $this->getField($dataField,'<?php echo $tes->'.$dataField['Field'].' ?>').PHP_EOL;
				}
				$file_view = str_replace("{isi_form}", $isi_form, $file_view);
				file_put_contents($path.'/views/'.strtolower($data['controler'])."_v_edit.php", $file_view);
				unlink($path."/views/v_edit.php");	
			}

			////////////////////////////////////////// End Exporter CI ////////////////////////
			///////////////////////////////////////// Start Exporter Yii /////////////////////

			function rename_yii_controler($path , $data){
				$file_controler = file_get_contents($path."/controllers/NamaControlerController.php");
				$file_controler = str_replace("{namaModel}", $data['model'], $file_controler);
				$file_controler = str_replace("{NamaControler}", $data['controler'], $file_controler);
				file_put_contents($path.'/controllers/'.strtolower($data['controler']).'Controller.php',$file_controler );
				unlink($path.'/controllers/NamaControlerController.php');
			}
			function rename_yii_model($path , $data){
				$file_model = file_get_contents($path."/models/namaModel.php");
				$file_model = str_replace("{namaModel}", $data['model'], $file_model);
				$file_model = str_replace("{namaTabel}", $data['tabel'], $file_model);
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				foreach ($kolom_form as $key => $v) {
					$temp = explode(",", $v['Comment']);
					if($temp[0]!=NULL){
						$label = $temp[0];
					}else{
						$label = $v['Field'];
					}
					$form .= addslashes('"'.$v['Field'].'"=>"'.$label.'",').PHP_EOL;
				}
				$file_model = str_replace("{attribute_label}", stripslashes($form), $file_model);
				foreach ($kolom_form as $key => $v) {
					$criteria .= addslashes('$criteria->compare("'.$v['Field'].'",$this->'.$v['Field'].');').PHP_EOL;
				}
				$file_model = str_replace("{criteria}", stripslashes($criteria), $file_model);
				//echo nl2br($file_model);
				file_put_contents($path.'/models/'.strtolower($data['model']).".php", $file_model);
				unlink($path."/models/namaModel.php");		
			}
			/////////////////////// Copy Folder di dalam view /////////////////////
			function copy_file_view_yii($path,$data){
					// buat folder sesuai controler
					mkdir($path.'/views/'.$data['controler']);
					// Copy Semua file ke folder tersebut
					$pl = new plugin();
					$pl->recurse_copy($path.'/views/NamaControler',$path.'/views/'.$data['controler']);
					$pl->recursiveRemoveDirectory($path.'/views/NamaControler');
			}

			function rename_yii_views_form($path , $data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/_form.php");
				$form = $this->renderForm($data['id_form']);
				foreach($form['detail_field'] as $dataField){ 
					$isi_form .= $this->getField($dataField,"").PHP_EOL;
				}
				$file_views = str_replace("{field}", $isi_form, $file_views);
				file_put_contents($path."/views/".$data['controler']."/_form.php", $file_views);
			}
			function rename_yii_views_view($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/_view.php");
				$form = $this->renderForm($data['id_form']);
				foreach($form['detail_field'] as $dataField){ 
					$temp = explode(",", $dataField['Comment']);					
					if($temp[0] != ""){
						$label = $temp[0];
					}else{
						$label = "ID";
					}
					$isi_form .= '<b>'.$label.':</b><?php echo $data->'.$dataField['Field'].' ?><br>'.PHP_EOL;
				}
				$file_views = str_replace("{view}", $isi_form, $file_views);
				file_put_contents($path."/views/".$data['controler']."/_view.php", $file_views);	
			}
			function rename_yii_views_admin($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/admin.php");
				$form = $this->renderForm($data['id_form']);
				$file_views = str_replace("{title}", $form['detail_form']['nama_form'], $file_views);
				$kolom = "";
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				foreach ($kolom_form as $key => $v) {
					$kolom .= $v['Field'].",".PHP_EOL;
				}
				$file_views = str_replace("{kolom}", $kolom, $file_views);
				file_put_contents($path."/views/".$data['controler']."/admin.php", $file_views);		
			}
			function rename_yii_views_create($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/create.php");
				$form = $this->renderForm($data['id_form']);
				$file_views = str_replace("{title}", $form['detail_form']['nama_form'], $file_views);
				file_put_contents($path."/views/".$data['controler']."/create.php", $file_views);		
			}
			function rename_yii_views_index($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/index.php");
				$form = $this->renderForm($data['id_form']);
				$file_views = str_replace("{title}", $form['detail_form']['nama_form'], $file_views);
				file_put_contents($path."/views/".$data['controler']."/index.php", $file_views);		
			}
			function rename_yii_views_update($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/update.php");
				$form = $this->renderForm($data['id_form']);
				$file_views = str_replace("{title}", $form['detail_form']['nama_form'], $file_views);
				file_put_contents($path."/views/".$data['controler']."/update.php", $file_views);		
			}
			function rename_yii_views_viewv($path,$data){
				$file_views = file_get_contents($path."/views/".$data['controler']."/view.php");
				$form = $this->renderForm($data['id_form']);
				$file_views = str_replace("{title}", $form['detail_form']['nama_form'], $file_views);
				$kolom = "";
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				foreach ($kolom_form as $key => $v) {
					$kolom .= $v['Field'].",".PHP_EOL;
				}
				$file_views = str_replace("{kolom}", $kolom, $file_views);
				file_put_contents($path."/views/".$data['controler']."/view.php", $file_views);		
			}
			//////////////////////////////////// End Exporter Yii///////////////////////////
			///////////////////////////////// Start Exporter HTML /////////////////////////
			function rename_html_controler($path,$data){
				///// Membaca Data
				$file_controler = file_get_contents($path."/controller/home.php");
				/////// Rename Controler
				$file_controler = str_replace("{controler}",strtolower($data['controler']),$file_controler);
				$file_controler = str_replace("{model}",strtolower($data['model']),$file_controler);
				$form = $this->renderForm($data['id_form']);
				$file_controler = str_replace("{title}", $form['detail_form']['nama_form'], $file_controler);
				$file_controler = str_replace("{table}", $data['tabel'], $file_controler);
				/// Get Column
				////// Save Controler
				file_put_contents($path.'/controller/'.ucfirst($data['controler']).".php", $file_controler);
				unlink($path."/controller/home.php");	
			}
			function rename_html_model($path , $data){
				$file_model = file_get_contents($path."/model/model.php");
				$file_model = str_replace("{model}",strtolower($data['model']),$file_model);
				$file_model = str_replace("{tabel}",strtolower($data['tabel']),$file_model);
				file_put_contents($path.'/model/'.strtolower($data['model']).".php", $file_model);
				unlink($path."/model/model.php");	
			}
			function rename_html_c($path,$data){
				$file_view = file_get_contents($path."/view/home.php");
				///////////////// Mengubah Header Tabel
				$kolom_form = $this->db->lihat_semua_kolom($data['nama_tabel']);
				foreach ($kolom_form as $key => $v) {
					if($v['Comment']!=NULL){
						$temp = explode(",", $v['Comment']);
						$label = $temp[0];	
					}else{
						$label = $v['Field'];	
					}
					$isi_header .=  '<td>'.$label.'</td>'.PHP_EOL;
					$isi .= '<td ><?php echo $v["'.$v['Field'].'"] ?></td>'.PHP_EOL;
				}
				$file_view = str_replace("{kolom_header}", $isi_header, $file_view);
				$file_view = str_replace("{kolom_isi}", $isi, $file_view);
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				//// End Header
				file_put_contents($path.'/view/'.strtolower($data['controler']).".php", $file_view);
				unlink($path."/view/home.php");	
			}
			function rename_html_view_tambah($path,$data){
				$file_view = file_get_contents($path."/view/home_tambah.php");
				$form = $this->renderForm($data['id_form']);
				///////////////// Mengubah Title base url dan controler
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				foreach($form['detail_field'] as $dataField){ 
					$isi_form .= $this->getField($dataField,$data_form[$dataField['Field']]).PHP_EOL;
				}
				$file_view = str_replace("{tambah}", $isi_form, $file_view);
				file_put_contents($path.'/view/'.strtolower($data['controler'])."_tambah.php", $file_view);
				unlink($path."/view/home_tambah.php");	
			}
			function rename_html_view_edit($path,$data){
				$file_view = file_get_contents($path."/view/home_edit.php");
				$form = $this->renderForm($data['id_form']);
				///////////////// Mengubah Title base url dan controler
				$file_view = str_replace("{controler}", $data['controler'], $file_view);
				foreach($form['detail_field'] as $dataField){ 
					$isi_form .= $this->getField($dataField,'<?php echo $e[0]["'.$dataField['Field'].'"] ?>').PHP_EOL;
				}
				$file_view = str_replace("{edit}", $isi_form, $file_view);
				file_put_contents($path.'/view/'.strtolower($data['controler'])."_edit.php", $file_view);
				unlink($path."/view/home_edit.php");	
			}
			//////////////////////////////// End Exporter HTML ////////////////////////////



			function renderExportForm($id_form){
				
			}
			function exportTabel($path,$data){
				$string = $this->db->backup_table($data['nama_tabel'],$data['tabel']);	
				$path = $path."/sql_export.sql";
				if (file_exists($path)) {
					# code...
					unlink($path);
				}
				file_put_contents($path, $string);
			}
			function zip_download($path,$data){
				$plugin = new plugin();
				$rand = uniqid();
				$zippath = $path."../exporter/".$data['nama_tabel'].".zip";
				if (file_exists($zippath)) {
					unlink($zippath);
				}
				$plugin->createZipFromDir($path, $zippath);
				header("location:http://".URL_HOME."/export.zip");
			}
			function zip_download_yii($path,$data){
				$plugin = new plugin();
				$rand = uniqid();
				$zippath = $path."../exporter/".$data['nama_tabel'].".zip";
				if (file_exists($zippath)) {
					unlink($zippath);
				}
				$plugin->createZipFromDirYii($path, $zippath);
				header("location:http://".URL_HOME."/export.zip");
			}

			function getField($field_detail,$value) {
				$data['field'] = $field_detail;
				list($data['text'],$data['tipe'],$data['other']) = explode(",", $field_detail['Comment'],3);
				//$data = $this->getData($field_detail);
				$data['tipe'] = trim($data['tipe']);
				switch($data['tipe']){
					case "text":
					return $this->renderText($data,$value);
					break;
					case "text_area":
					return $this->renderTextArea($data,$value);
					break;
					case "number":
					return $this->renderNumber($data,$value);
					break;
					case "select":
					return $this->renderSelect($data,$value);
					break;
					case "date":
					return $this->renderDate($data,$value);
					break;
					case "file":
					return $this->renderFile($data,$value);
					break;
					case "bool":
					return $this->renderBool($data,$value);
					break;
					case "check":
					return $this->renderCheck($data,$value);
					break;
				}
			}
}