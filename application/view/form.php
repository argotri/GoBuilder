<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title><?php echo $form['detail_form']['nama_form']  ?>-<?php echo NAMA_SISTEM ?></title>
<!-- DataTables CSS -->
    <?php 
	$this->loadAsset("css" , "css/plugins/dataTables.bootstrap.css",'');
	?>
</head>

<body>
<script type="text/javascript">
<?php if($insert){ ?>
	alert("Data Berhasil Dimasukkan");
	window.location = "<?php echo $this->renderUrl("form","viewData",$id_form); ?>";
<?php };?>
<?php if($editData){ ?>
	alert("Data Berhasil Dilakukan Pengeditan");
	window.location = "<?php echo $this->renderUrl("form","viewData",$id_form); ?>";
<?php }else if($editData == 'tidak_berubah'){?>
	alert("Data Tidak Berubah , karena Tidak ada data yang diedit");
	window.location = "<?php echo $this->renderUrl("form","viewData",$id_form); ?>";
<?php }; ?>
<?php if($hapusData){ ?>
	alert("Data Berhasil Dihapus");
	window.location = "<?php echo $this->renderUrl("form","viewData",$id_form); ?>";
<?php } else if($hapusData == "tidak_dihapus"){ ?>
	alert("Data Tidak dihapus , dikarenakan data sudah tidak ada");
	window.location = "<?php echo $this->renderUrl("form","viewData",$id_form); ?>";
<?php }; ?>
</script>

<div id="wrapper">
  <?php $this->loadViewInclude("navigator"); ?>
  <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header"><?php echo $form['detail_form']['nama_form'] ?></h1>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        
		<div class="row">
        	<div class="panel panel-default">
           		<div class="panel-heading"> <?php echo $form['detail_form']['nama_form'] ?>
                <div class="pull-right">
                <?php if($act != "view_form"){ ?>
                <a class="btn btn-primary btn-outline btn-xs" href="<?php $this->renderUrl("form","view",$id_form); ?>"><i class="fa fa-plus"></i> Insert Data</a>
                <?php }else{ ?>
                <a class="btn btn-primary btn-outline btn-xs" href="<?php $this->renderUrl("form","viewData",$id_form); ?>"><i class="fa fa-print"></i> View Data</a>
                <?php }; ?>
                </div>
                
                </div>
				<div class="panel-body">
                <?php if($act == "view_form"){ ?>
                <?php 
					if($aksi != 'editData'){
						$aksi = 'insertData';
					}
				?>
                <form onsubmit="loadingForm()" role="form" method="post" enctype="multipart/form-data" action="<?php echo $this->renderUrl("form",$aksi,$id_form."/".$id_data); ?>">				
                	<?php 
					foreach($form['detail_field'] as $dataField){ 
						echo $this->getField($dataField,$data_form[$dataField['Field']]);
					}
					?>
                    <input type="submit" class="btn btn-outline btn-primary" value="Simpan">
					<span style="display:none;" id="load">Please Wait... <?php $this->loadAsset("img" , "gambar/load.gif",''); ?></span>
                 </form>
                 <?php }; ?>
                 <?php if($act == "view_data"){ ?>
                 <?php
                 //var_dump($form);
				 ?>
                 <div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover dataTable no-footer" id="data_tabel">
                 <thead>
                 <tr>
      			  <?php for($i=1;$i<=count($header_tabel);$i++){ ?>
                  <th><?php echo $header_tabel[$i]['text']; ?></th>
                  <?php }; ?>
                  <th>Action</th>
                  </tr>
                  </thead>
                  </table>
                  </div><!-- End Table-responnsive div -->
                 <?php }; ?>
                </div>
            </div>
        </div><!-- / row-->
      <!-- /#page-wrapper --> 
    </div>
  </div>
</div>
<!-- /#wrapper -->
<?php $this->loadViewInclude("footer"); ?>
<script type="text/javascript">
 /* Here we will store all data */
// COba ni http://stackoverflow.com/questions/13147809/jquery-draggable-sortable-changing-html-on-dropped-element
$(function() {
	$( ".sortable" ).sortable({
		revert: true,
		update:function (event, ui) {
			var data = $(this).sortable('serialize');
		}
	});
	/*
	$( ".form_field" ).draggable({
		connectToSortable: ".sortable",
		helper: "clone",
		revert: "invalid"
	});
  */
 
 });// End Function
 
</script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<!-- DataTables JavaScript -->
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.js",''); ?>    
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.bootstrap.js",''); ?>
    <script>
    $(document).ready(function() {
		
        $('#data_tabel').dataTable({

		"processing": true,
	        "serverSide": true,
    	    "ajax": "<?php echo $this->renderUrl("form","viewDataAjax",$id_form) ?>/",
			"aoColumnDefs": [ {
			      "aTargets": [<?php echo ($i-1) ?>],
			      "mData": "download_link",
			      "mRender": function ( data, type, full ) {
			       return '<a href="<?php echo $this->renderUrl("form","view",$id_form."/"); ?>'+full[<?php echo MAX_NUMBER ?>]+'" title="edit"><i class="fa fa-pencil-square-o">&nbsp</i></a> <a href="#!" onclick="hapus_konfirm(\''+addslashes(full[0])+'\',\'#dialog\',\'<?php echo $this->renderUrl("form","hapusData",$id_form."/") ?>'+full[<?php echo MAX_NUMBER ?>]+'\')" title="Hapus"><i class="fa  fa-trash-o">&nbsp</i></a>';
			    		  }
				    } ]
		});
    });
	function loadingForm(){
		$("#load").show();
	}
	function addslashes(str) {
  //  discuss at: http://phpjs.org/functions/addslashes/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Ates Goral (http://magnetiq.com)
  // improved by: marrtins
  // improved by: Nate
  // improved by: Onno Marsman
  // improved by: Brett Zamir (http://brett-zamir.me)
  // improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
  //    input by: Denny Wardhana
  //   example 1: addslashes("kevin's birthday");
  //   returns 1: "kevin\\'s birthday"

  return (str + '')
    .replace(/[\\"']/g, '\\$&')
    .replace(/\u0000/g, '\\0');
}
    </script>
</body>
</html>