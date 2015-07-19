<?php
interface database{
	/*public $last_result;
	private $db;*/
	/*
	 *  ingat , Var db exec menghasilkan nilai 0 jika benar , dan tidak menghasilkan apa2 jika salah INGAT INGAT INGAT
	 */
	public function __construct($server , $username , $password,$database,$port = '');
	public function ConnectDatabase($server ,  $username , $password,$database, $port );
	public function lihat_semua_tabel();
	public function lihat_semua_kolom($nama_tabel);
	public function kirim_query($query);
	public function login($username , $password);
    public function close_conection();
	public function getDBObject();
    ///// Insert Update Delete Select
    public function insert($tabel , $isi);
	public function select($tabel,$where="",$orderby="",$kolom);
	public function delete($tabel , $where='');
	public function deleteTabel($tabel);
	public function edit($tabel , $primari_key ,$isi);
	public function getLastInsertID();
    /// End Insert Update Delete Select;
    public function createTabel($namaTabel , $isiTabel);   
	public function selectTipeTabel($tipe , $data = NULL) ;
	public function backup_table($nama_tabel,$new_table="");
}
?>