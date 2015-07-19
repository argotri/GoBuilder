<?php
define("NAMA_SISTEM","Administrasi Travel"); // Nama Sistem Yang Digunakan

define("DATABASE_DRIVER","mysql");// mysql , oracle , mssql
define("DATABASE_HOST","localhost");
define("DATABASE_USER","argo");
define("DATABASE_PASSWORD","argo");
define("DATABASE_NAME","gobuilder");

/*
define("DATABASE_DRIVER","oracle");// mysql , oracle , mssql
//define("DATABASE_HOST","sqlServerTugasAkhir"); // Bisa juga sebagai ODBC
define("DATABASE_HOST","OracleTugasAkhir"); // Bisa juga sebagai ODBC
define("DATABASE_USER","argo12");
define("DATABASE_PASSWORD","argo12");
define("DATABASE_NAME","ARGO12");
*/



define("PATH_FOLDER", 'tugas_akhir');
//define("HOST","localhost");
define("HOST",$_SERVER['SERVER_NAME']);
//define("URL_HOME", "localhost/".PATH_FOLDER); // Tanpa menggunakan HTTP / HTTPS , mengikuti nanti protokol standard
define("URL_HOME", HOST."/".PATH_FOLDER); // Tanpa menggunakan HTTP / HTTPS , mengikuti nanti protokol standard
define("DEFAULT_CONTROLER","home"); // Digunakan untuk controler default
define("DEFAULT_404","n404"); // Digunakan untuk controler default 404
define("ASSET_FOLDER","/".PATH_FOLDER."/asset"); // Digunakan untuk Alamat Asset
define("AWALAN_FORM","FORM_"); // Digunakan Untuk Awalan dari Form
define("MAX_NUMBER","9999999999"); // Jangan dirubah , digunakan untuk menyembunyikan id
define("UPLOAD_FOLDER","user_data/"); // Jangan dirubah , digunakan untuk menaruh folder user upload
?>