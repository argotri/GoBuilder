// JavaScript Document

function load_halaman(id_halaman,url_halaman){
	$(id_halaman).html("Loading");
	$(id_halaman).load(url_halaman);
}
function load_halaman_silent(id_halaman,url_halaman){
	$(id_halaman).load(url_halaman);
}
function load_halaman_hide(id_hide,url_halaman){
	$(id_halaman).html("Loading");
	$(id_hide).load(url_halaman);
	$(id_hide).hide(1000);
}

function buka_dialok() {
		$( "#dialog" ).dialog( "open" );
		return false;
}
function tanggal(tanggal_id){
        $(tanggal_id).datepicker();
}
function buka_dialog(id,halaman){
	load_halaman(id,halaman);
	$(id).dialog();
}

function toggleChecked(status,id_box) {
	$(id_box+" input").each( function() {
		$(this).attr("checked",status);
	});
}

function submit_ajax(url,id_form,id_result){
	$(id_halaman).html("Loading");
	$.post(url,$(id_form).serialize(), function(data) {
	  $(id_result).html(data);
	});
}
function ambil_date(id_text){
	$(id_text).datepicker({ dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true,yearRange: '1991:'  });
}

function hapus_konfirm(text_hapus , id_dialog,link_hapus){
	 var ret;
	jQuery.fancybox({
	modal : true,
	content : "<div style=\"width:240px;\"> Apa anda yakin ingin menghapus <b>"+text_hapus+" </b> ?<div style=\"text-align:right;margin-top:10px;\"><a href='#!' onclick='jQuery.fancybox.close()' class=\"btn btn-danger btn-outline\"> <i class=\"fa fa-times\"></i> Tidak </a> &nbsp; &nbsp; <a href='"+link_hapus+"' class=\"btn btn-outline btn-primary\"> <i class=\"fa fa-check\"></i> Ya </a></div></div>",
	});
} // End Fungsinya

$(document).ready(function(){ 
	$(".tanggal" ).datepicker({
			changeMonth: true,
			changeYear: true,yearRange: '1900:2100',
			dateFormat: 'yy-mm-dd'		
	});
});
function submit_form(id_form,id_content,alamat_proses){
	$('#'+id_content).html('Loading');
	$.ajax({ 
	   url: alamat_proses, 
	   data: $('#'+id_form).serialize(),
	   cache: false, 
	   success: function(html){ 
      $('#'+id_content).html(html); 
   } 
});
}
function submit_form2(id_form,id_content,alamat_proses){
	$.ajax({ 
	   url: alamat_proses, 
	   data: $('#'+id_form).serialize(),
	   cache: false, 
	   success: function(html){ 
	  $('#'+id_content).html('Loading');
      $('#'+id_content).html(html); 
   } 
});
}	    
function show(id){
	$('#'+id).slideDown(1000);
};
function hide(id){
	$('#'+id).slideUp(1000);
};
function tutup(){
	self.window.close();	
}