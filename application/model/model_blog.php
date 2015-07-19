<?php
class model_blog extends Application
{
    function __construct()
    {
     	/*$this->loadProduct("database_selector");
     	$this->db = $this->database_selector->PilihDatabase();*/
    }

    function select()
    {
        return $this->db->kirim_query("Select * from tes_tabel");
    }
    function pilih(){
            return $this->db->lihat_semua_tabel();
    }
}
?>