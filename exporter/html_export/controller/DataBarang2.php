<?php
class databarang2 extends Application
{
    function __construct()
    {
		$this->loadModel("modeldatabarang2");
    }
    
    function index()
    {	
		$data['judul'] = "Data Barang";
		$data['db'] = $this->modeldatabarang2->select();
        $this->loadView('databarang2',$data);
    }
	function delete($id_delete){
		$this->modeldatabarang2->delete("data_barang",$id_delete[0]);
		$this->redir("databarang2",'','','Data Berhasil Dihapus');
	}
	function tambah(){
		$data['judul'] = "Data Barang";
		$this->loadView('databarang2_tambah',$data);
	}
	function tambah_data(){
		$this->modeldatabarang2->tambah("data_barang", $_POST);		
		$this->redir("databarang2",'','','Data Berhasil Ditambah');
	}
	function edit($id_edit){
		$data['judul'] = "Data Barang";
		$data['id_edit'] = $id_edit[0];
		$data['e'] = $this->modeldatabarang2->select2($id_edit[0]);
		$this->loadView('databarang2_edit',$data);
	}
	function edit_data(){
		$this->modeldatabarang2->edit("data_barang", $_POST);		
		$this->redir("databarang2",'','','Data Berhasil Diedit');
	}
}
?>
