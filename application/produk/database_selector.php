<?php
	//require_once 'mysql.php';
	class database_selector extends Application{
		private $object_database;
		public function __construct(){
			$this->loadFactory("mysql");
			$this->loadFactory("mssql");
			$this->loadFactory("oracle");
			return $this->PilihDatabase();
		}
		public function PilihDatabase(){
			switch (DATABASE_DRIVER) {
				case "mysql":
				return $this->object_database = new mysql(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);					
				break;
				case "mssql":
				return $this->object_database = new mssql(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);					
				break;
				case "oracle":
				return $this->object_database = new oracle(DATABASE_HOST, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);					
				break;
				default:
					;
				break;
			}
		}
	}
	
?>