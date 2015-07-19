<?php
class {controler} extends Application
{
    function __construct()
    {
		$this->loadModel("{model}");
    }
    
    function index()
    {	
		$data['judul'] = "{title}";
		$data['db'] = $this->{model}->select();
        $this->loadView('{controler}',$data);
    }
	function delete($id_delete){
		$this->{model}->delete("{table}",$id_delete[0]);
		$this-> redir("{controler}",'','','Data Berhasil Dihapus');
	}
	function tambah(){
		$data['judul'] = "{title}";
		$this->loadView('{controler}_tambah',$data);
	}
	function tambah_data(){
		$this->{model}->tambah("{table}", $_POST);		
	}
	function edit($id_edit){
		$data['judul'] = "{title}";
		$data['id_edit'] = $id_edit[0];
		$this->loadView('{controler}_edit',$data);
	}
	function edit_data(){
		$this->{model}->edit("{table}", $_POST);		
	}
}
?>
