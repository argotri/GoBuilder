<?php 
class  modelReportManagement extends Application {
		function __construct()
		{
			$this->loadProduct("database_selector");
			$this->db = $this->database_selector->PilihDatabase();
		}
		function showAllReport(){
			return  $this->db->select("laporan","","nama_laporan ASC");
		}
		function pecahKolom($detail_field){
			$ret = array();
			//var_dump($detail_field);
			for($i=1;$i<count($detail_field);$i++){
				list($ret[$i]['text'],$ret[$i]['tipe'],$ret[$i]['other']) = explode(",", $detail_field[$i]['Comment'],3);
				$ret[$i]['nama_field']= $detail_field[$i]['Field'];
			}
			return $ret;
		}
		function inputReport($value){
			$insert['nama_laporan'] = $value['nama_report'];
			$insert['judul_laporan'] = $value['judul_report'];
			$insert['nama_tabel'] = $value['nama_tabel'];
			$insert['tipe_laporan'] = $value['tipe'];
			$insert['user_create'] = $_SESSION['username'];
			$insert['id_form'] = $value['table'];
			$this->db->insert('laporan' , $insert);
			return $this->db->getLastInsertID();
		}
		function inputKolomReport($kolom , $judul , $opsi,$id_laporan){
			foreach($kolom as $key => $value){
				$insert['id_laporan'] = $id_laporan;
				$insert['judul_kolom'] = $judul[$key];
				$insert['urutan_kolom'] = ++$i;
				$insert['nama_kolom_tabel'] = $kolom[$key];
				$insert['fungsi'] = $opsi[$key];
				$this->db->insert('laporan_rekap' , $insert);
			}
			return true;
		}
		function editReport($value,$id_laporan){
			$data['nama_laporan'] = $value['nama_report'];
			$data['judul_laporan'] = $value['judul_report'];
			$data['nama_tabel'] = $value['nama_tabel'];
			$data['tipe_laporan'] = $value['tipe'];
			$data['user_create'] = $_SESSION['username'];
			$data['id_form'] = $value['table'];
			return $this->db->edit("laporan"," id_laporan = ".$id_laporan,$data);
		}
		function deleteTabelReport($id_report){
			return $this->db->delete('laporan' , 'id_laporan = '.$id_report);
		}
		function deleteKolomReport($id_report){
			return $this->db->delete('laporan_rekap' , 'id_laporan = '.$id_report);
		}
		function detailReportData($id_report){
			return $this->db->select("laporan" , "id_laporan = ". $id_report);
		}
		function detailReportKolom($id_report){
			return $this->db->select("laporan_rekap" , "id_laporan = ". $id_report, " urutan_kolom ASC ");
		}

		function getIsiReport($tabel , $kolom ,$cari = ''){
				$det_tabel = $this->db->lihat_semua_kolom($tabel);
				//var_dump($det_tabel);
				/// Joining tabel
				$select = array();
				foreach($kolom as $v){
					for($cc =  1 ; $cc < count($det_tabel) ; $cc++){
						if($v['nama_kolom_tabel'] == $det_tabel[$cc]['Field']){ /// Mencari kolom yang dipilih saja
							// Mencari Yg tipenya Select yang dinamis
							if(strpos($det_tabel[$cc]['Comment'],"select") && strpos($det_tabel[$cc]['Comment'],"dimamis")){ 
								$mentah = explode(",",$det_tabel[$cc]['Comment'],5);
								/* Mentah 
								0 = Label dari tabel join sebelah
								1 = tipe select
								2 = dinamis / statis 
								3 = tabel tujuan join
								4 = kolom dari tabel tujuan join
								*/
								array_push($select,$mentah[3].".".$mentah[4]."  ".$v["nama_kolom_tabel"]." ");
								$tbl2nd .= " LEFT JOIN ". $mentah[3] ." ON ".$tabel.".".$v['nama_kolom_tabel']." = ".$mentah[3].".ID";
								//$s = 
							}else{
								array_push($select,$v['nama_kolom_tabel']);
							}
							break;
						}
					}
				}
				//////////////// Digunakan apakah tabel berisi join atau tidak 
				if($tbl2nd != NULL){
					$tabel = $tabel." ".$tbl2nd;
				}
				
				/// Filtering Tabel
				foreach($kolom as $value){
					$where .= $value['nama_kolom_tabel']." LIKE '%".$cari."%' OR ";
				}
				$where = substr($where,0,-3);
				return $this->db->select($tabel,$where,"","",$select);
		}
}
?>