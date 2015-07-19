<?php
require_once 'database_interface.php';

class  oracle extends Application implements database {
	public $var_database;
	// Digunakan untuk Membuat koneksi database
	public function __construct($server , $username , $password,$database,$port = ''){
		$this->ConnectDatabase(DATABASE_HOST , DATABASE_USER, DATABASE_PASSWORD,DATABASE_NAME,'');
	}
	public function ConnectDatabase($server , $username , $password,$database, $port ){
		try {
			$var_string = 'odbc:'.$server;
			$this->var_database= new PDO($var_string, $username, $password);
			$this->var_database->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
		} catch (Exception $e) {
			echo "Kesalahan Koneksi . <br>".$e->getMessage();
		}
	}
	public function close_conection(){
	
	}
	public function getDBObject(){
		return $this->var_database;
	}
	private function exec($query){
		return $this->var_database->exec($query);
	}
	public function kirim_query($query){
		//echo $query;
		//Default fetch assoc
		try {
			$stmt = $this->var_database->query($query);
			if($stmt){
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		} catch (Exception $e) {
			echo "Terjadi Kesalahan Dalam Query ".$query.'<br>';
			echo $e->getMessage();
			exit;
		}
		return $results;
	}
	public function lihat_semua_kolom($nama_tabel){
		//$query = "show FULL COLUMNS from ".$nama_tabel;
		$query = "select * from information_schema.columns where table_name = '".$nama_tabel."'";
		$stmt = $this->var_database->query($query);
		$results = array();

		if($stmt){
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		var_dump($results);
		return  $results;
	}
	public function lihat_semua_tabel(){
		$stmt = $this->var_database->query("Show tables");
		$results = $stmt->fetchAll(PDO::FETCH_COLUMN);
		return  $results;
	}
    public function login($username , $password){
    	$username = "'".$username."'";
    	$password = "'".md5($password)."'";
        $query = 'SELECT * from "user" where "username" = '.$username.' AND "password" = '.$password;
        return $this->kirim_query($query);
    }
    // Digunakan Untuk Insert edit delete select 
	public function select($namaTabel , $where = "", $orderBy="" , $limit = '',$kolom = ''){
		/*
			$namaTabel : Digunakan untuk menyelect nama tabel , Bisa juga dilakukan join disini
			$where : digunakan untuk wherying , filtering dan ing ing yang lain , manual ya AB = B , dsb
			$orderBy : digunakan untuk mengurutkan Kolom tabelnya
		*/
		if($kolom == ''){
			$query = 'Select * from "'.$namaTabel.'"';
		}else{
			if(is_array($kolom)){
				$query = 'Select '.implode(",",$kolom).' from "'.$namaTabel.'"' ;
			}else{
				$query = 'Select '.$kolom.' from "'.$namaTabel.'"' ;
			}
		}
		
		
		if($where!=NULL){
			$query .= "where ".$where." ";
		}
		if($orderBy!=NULL){
			$orderBy = explode(" ", $orderBy);
			$orderBy[0] = '"'.$orderBy[0].'"';
			$orderBy = implode(" ", $orderBy);
			$query .= " ORDER BY ".$orderBy;
		}
		//echo $query;
		return $this->kirim_query($query);
	}
    public function insert($tabel , $isi) {
    	if(is_array($isi)){
			$query = 'INSERT INTO ' . $tabel. " SET ";
			
			foreach($isi as $key=>$value){
				//$query .= '`' . $key . '` = "' . $value . '", ';
				$query .= "`{$key}` = '{$value}', ";
			}
			$query = substr($query, 0, -2);
			//echo $query;
			$ins = $this->var_database->exec($query);
			if ($ins) {
				return true;
			} else {
				return false;
			}
    	}else{
    		return false;
    	}
    }
    
    public function delete($tabel , $where = '') {
    	$query = "Delete From ".$tabel." ";
    	if($where !=NULL){
    		$query .= " WHERE ".$where;
    	}

    	return $this->var_database->exec($query);
    }
	
	public function edit($tabel , $where ,$isi) {
    	if(is_array($isi)){
			$query = 'UPDATE ' . $tabel. " SET ";
			
			foreach($isi as $key=>$value){
				//$query .= '`' . $key . '` = "' . $value . '", ';
				$query .= "`{$key}` = '{$value}', ";
			}
			$query = substr($query, 0, -2);			
			$query .= ' WHERE '. $where ;
			$ins = $this->var_database->exec($query);
			if ($ins) {
				return true;
			} else {
				return false;
			}
			//echo $query;
    	}else{
    		return false;
    	}
    }
	public function getLastInsertID(){
		return $this->var_database->lastInsertId();
	}
    ///////////// End CRUD
    // Tabel Create
    public function createTabel($namaTabel , $isiTabel) {
    	$query = "CREATE table ".$namaTabel." ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ,";
    	foreach ($isiTabel as $value) {
    		$field = $this->normalisasiText($value['label']).++$i;
    		$tipe = $this->selectTipeTabel($value['tipe'] , '');
    		$query .= " ".$field." ".$tipe." ";
    		if($value['wajib']){
    			$query .= " NOT NULL ";
    		}else{
    			$query .= " NULL ";
    		}
			$value["other"] = "";
			//var_dump($value);
			/*
			Untuk Filter masing - masing tipe
			*/
			///////////// Urut urutannya : <dinamis/statik>|{<namatabel/valuenya>}
			if($value['tipe'] == "select"){
				if($value['tipe_select'] == "statis"){
					$value["other"] .= "statis,";
					$value["other"] .= implode("|",$value["property_select"]);
				}else{
					$value["other"] .= "dimamis,";
					
					$value["other"] .= $value['nama_tabel'].",".$value['nama_value'];
				}
			}
			if($value['tipe'] == "check"){
				$value["other"] .= implode("|",$value["property_cek"]);
			}
			if($value['tipe']=='file'){
				$value['other'] = $value['filter'];
			}
			
			/* End Filter Masing - Masing Tipe */
    		 $query .= " Comment '".$value['label'].",".$value['tipe']." , ".$value['other']." ' ,";
    	}
    	$query = substr($query, 0, -2);
    	$query .= " ) ";
		//echo $query;
    	return  $this->var_database->exec($query);
    }

    // End Tabel CReate
    // Tabel Delete 
    public function deleteTabel($tabel) {
    	$query = "DROP TABLE ".$tabel." ";
    	return  $this->var_database->exec($query);
    }
    //End tabel Delete
	
	function selectTipeTabel($tipe , $data = NULL , $panjang = "") {
    	//-_- Jangan Lupa ditambahi Post Panjang Fieldnya , Sory Kelupaan broo ///

    	switch ($tipe){
    		case "text":
				if($panjang == ""){
					$panjang = "200";
				}
    			return "VARCHAR(".$panjang.")";
    			break;
    		case "file":
    			return "text";
    			break;
    		case "select":
    			return "VARCHAR(200)";
    			break;
    		case "number":
				if($panjang == ""){
					$panjang = "30";
				}
    			return "INT(".$panjang.")";
    			break;
    		case "text_area":
    			return "text";
    			break;
    		case "date":
    			return "date";
    			break;
    		case "bool":
    			return "tinyint(1) NULL DEFAULT 0  ";
    			break;
    		case "check":
    			return "text ";
    			break;
    	}
    }
    function backup_table($tables,$new_table=""){
    	if($new_table == ""){
    		$new_table = $tables;
    	}
    	 $data = "\n/*---------------------------------------------------------------".
          "\n  SQL DB BACKUP ".date("d.m.Y H:i")." ".
          "\n  HOST: {$host}".
          "\n  DATABASE: {$name}".
          "\n  TABLES: {$new_table}".
          "\n  ---------------------------------------------------------------*/\n";
		  $this->kirim_query( "SET NAMES `utf8` COLLATE `utf8_general_ci`"); // Unicode

		  if($tables == '*'){ //get all of the tables
		    $tables = array();
		    $result = $this->kirim_query("SHOW TABLES");
		    foreach($row as $rw){
		      $tables[] = $rw;
		    }
		  }else{
		    $tables = is_array($tables) ? $tables : explode(',',$tables);
		  }
		  
		  
  	foreach($tables as $table){
		    $data.= "\n/*---------------------------------------------------------------".
		            "\n  TABLE: `{$new_table}`".
		            "\n  ---------------------------------------------------------------*/\n";           
		    $data.= "DROP TABLE IF EXISTS `{$new_table}`;\n";
		    $row = $this->kirim_query("SHOW CREATE TABLE `{$table}`");

		    ///////////////// Membuat Struktur Tabel////////////////////////////
		    foreach ($row as $kunci => $isi) {
		    	# code...
		    	$create = str_replace(strtolower($table), strtolower($new_table), strtolower($isi['Create Table']));
		    	$data.= $create.";\n";

		    }
		    

		    
		    $result = $this->kirim_query("SELECT * FROM `{$table}`");
		    $num_rows = count($result);    

		    if($num_rows>0){
		    	
		      $vals = Array(); $z=0;
		      
		      for($i=0; $i<$num_rows; $i++){
		        $items = $result[$i];
		        $vals[$z]="(";
		        foreach ($items as $kunci => $isi) {
		          if (isset($isi)) { $vals[$z].= "'".$isi."'"; } else { $vals[$z].= "NULL"; }
		          $vals[$z].= ","; 
		        }
		        $vals[$z] = rtrim($vals[$z],",");
		        $vals[$z].= ")"; $z++;
		      }
		      $data.= "INSERT INTO `{$new_table}` VALUES ";      
		      $data .= "  ".implode(";\nINSERT INTO `{$new_table}` VALUES ", $vals).";\n";
		    }
		  }

		  return $data;
    }
}
?>