<?php 
class plugin{
	function in_array_r($needle, $haystack, $strict = false) {
		foreach ($haystack as $item) {
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
				return true;
			}
		}
	
		return false;
	}
	function encode_json($val)
		 {
			 if (is_string($val)) return '"'.addslashes($val).'"';
			 if (is_numeric($val)) return $val;
			 if ($val === null) return 'null';
			 if ($val === true) return 'true';
			 if ($val === false) return 'false';
		
			 $assoc = false;
			 $i = 0;
			 foreach ($val as $k=>$v){
				 if ($k !== $i++){
					 $assoc = true;
					 break;
				 }
			 }
			 $res = array();
			 foreach ($val as $k=>$v){
				 $v = plugin::encode_json($v);
				 if ($assoc){
					 $k = '"'.addslashes($k).'"';
					 $v = $k.':'.$v;
				 }
				 $res[] = $v;
			 }
			 $res = implode(',', $res);
			 return ($assoc)? '{'.$res.'}' : '['.$res.']';
		 }
		 function tanggal2($send_tanggal){
 		   list($tahun,$bulan,$tanggal)=explode('-',$send_tanggal);
		   return $tanggal.'/'.$bulan.'/'.$tahun;
		}
	function recurse_copy($src,$dst) { 
		$dir = opendir($src); 
		@mkdir($dst); 
		while(false !== ( $file = readdir($dir)) ) { 
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					$this->recurse_copy($src . '/' . $file,$dst . '/' . $file); 
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
				} 
			} 
		} 
		closedir($dir); 
	} 
		function recursiveRemoveDirectory($directory)
	{
		foreach(glob("{$directory}/*") as $file)
		{
			if(is_dir($file)) { 
				$this->recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
		rmdir($directory);
	}
	function createZipFromDir($dir, $zip_file) {
	   		$zipFile = "export.zip";
	   		if (file_exists($zipFile)) {
	   			unlink($zipFile);
	   		}
			$zipArchive = new ZipArchive();

			if (!$zipArchive->open($zipFile, ZIPARCHIVE::OVERWRITE))
			    die("Failed to create archive\n");

			$scanned_directory = array_diff(scandir($dir), array('..', '.'));

			$temp = $scanned_directory;
			foreach ($scanned_directory as $key => $value) {
				if(strpos($value , ".")!=false){
					unset($temp[$key]);
				}
			}
			$scanned_directory = $temp;
			/// Buat diluar MVCnya
			$zipArchive->addGlob($dir."/*.*");
			//// buat MVCnya
			foreach ($scanned_directory as $key => $value) {
				# code...
				$zipArchive->addGlob($dir."/".$value."/*.*");
			}

			
			if (!$zipArchive->status == ZIPARCHIVE::ER_OK)
			    echo "Failed to write files to zip\n";

			$zipArchive->close();
	}
	function createZipFromDirYii($dir, $zip_file) {
	   		$zipFile = "export.zip";
	   		if (file_exists($zipFile)) {
	   			unlink($zipFile);
	   		}
			$zipArchive = new ZipArchive();

			if (!$zipArchive->open($zipFile, ZIPARCHIVE::OVERWRITE))
			    die("Failed to create archive\n");
		
			$scanned_directory = array_diff(scandir($dir), array('..', '.'));

			$temp = $scanned_directory;
			foreach ($scanned_directory as $key => $value) {
				if(strpos($value , ".")!=false){
					unset($temp[$key]);
				}
			}
			$scanned_directory = $temp;
			/// Buat diluar MVCnya
			$zipArchive->addGlob($dir."/*.*");
			//// buat MVCnya
			foreach ($scanned_directory as $key => $value) {
				# code...
				$zipArchive->addGlob($dir."/".$value."/*.*");
			}
			/// buat didalam viewnya
			$scanned_directory = array_diff(scandir($dir."/views/"), array('..', '.'));

			$temp = $scanned_directory;
			foreach ($scanned_directory as $key => $value) {
				if(strpos($value , ".")!=false){
					unset($temp[$key]);
				}
			}
			$scanned_directory = $temp;
			foreach ($scanned_directory as $key => $value) {
				# code...
			$zipArchive->addGlob($dir."/views/".$value."/*.*");
			}
			/////////// End Buat Viewnya
			if (!$zipArchive->status == ZIPARCHIVE::ER_OK)
			    echo "Failed to write files to zip\n";

			$zipArchive->close();
	}

}
?>