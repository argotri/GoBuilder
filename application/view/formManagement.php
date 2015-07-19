<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title>Form Management -<?php echo NAMA_SISTEM ?></title>
<!-- DataTables CSS -->
    <?php 
	$this->loadAsset("css" , "css/plugins/dataTables.bootstrap.css",'');
	//$this->loadAsset("css" , "css/plugins/jquery.dataTables.css",'');
	?>
</head>

<body>
<?php 
if($status_hapus){ ?>
<script type="text/javascript">
	alert("Form Berhasil Dihapus");
	window.location = '<?php $this->renderUrl("formManagement"); ?>';
</script>
<?php }; ?>
<div id="wrapper">
  <?php $this->loadViewInclude("navigator"); ?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Form Management </h1>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
    <?php if($aksinya==NULL){ ?>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading"> <i class="fa fa-plus-square fa-fw"></i> List Form 
            <!-- Buat menu samping -->
            <div class="pull-right">
              <a href="<?php $this->renderUrl("formManagement","tambah"); ?>" class="btn btn-default btn-xs "><i class="fa fa-plus-square fa-fw"></i>Tambahkan Form</a>
              </div><!-- End menu Samping--> 
          </div><!-- End Heading-->  
		<div class="panel-body"> 
			<div class="table-responsive">
            	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataform">
                <thead>
                <tr class="warning">
                	<th>No</th>
                	<th>Nama Form</th>
                	<!--<th>Tabel</th>-->
                	<th>Waktu Update</th>
                	<th>Aksi</th>
				</tr>
                <thead>
            <tbody>
			<?php 
			if($listform!=NULL){
			foreach($listform as $lv){ ?>
                <tr>
                  <td><?php echo ++$i ?></td>
                  <td><?php echo $lv['nama_form'] ?></td>
                  <!--<td><?php echo $lv['nama_tabel'] ?></td>-->
                  <td><?php echo $lv['tgl_create'] ?></td>
                  <td><a href="<?php $this->renderUrl("form","view",$lv['id_form']) ; ?>">View</a> | <a href="#!" onClick="hapus_konfirm('<?php echo $lv['nama_form'] ?>' , '#dialog','<?php $this->renderUrl("formManagement","delete",$lv['id_form']) ; ?>')">Delete</a> | <a href="<?php $this->renderUrl("formManagement","export",$lv['id_form']) ?>" class="fc_phone fancybox.ajax">Export</a></td>
                </tr>
			<?php };} // End if end foreach?>
			</tbody>
				</table>
            </div><!-- End Tabel -->
        </div>
        </div>
      </div>
      <!-- /.row -->
      <?php }; /////////// End Buat list form ?>
      <?php if($aksinya == 'tambah'){ ?>
      <form action="<?php $this->renderUrl('formManagement','tambahForm','') ?>" method="post">
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <input class="title_form" type="text" name="judul_form" value="" required placeholder="Inputkan Judul Form anda">
                <div class="pull-right">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-outline btn-primary btn-xs"><i class="fa fa-save"></i> Save Form</button>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <div class="sortable" id="element_form">
                </div>	
				<a onClick="tambahField()" href="#!" class="btn  btn-primary col-lg-12">Tambahkan Field Baru</a>
              </div>
            </div>
          </div>
        </div>
        <!-- End Row-->
        <input type="hidden" id="form_isi">
        <div id="result"></div>
      </form>
      <script type="text/javascript">
	  /////////////////////////// todo 
	  ///////////// bikin object jsson d javascript
	  var id_field = 0;
	  function tambahField(){
		  $("#element_form").append($("<div id='id_"+id_field+"' class='row form_field'>").load("<?php echo $this->renderUrl("formManagement","tambahField"); ?>/"+id_field ));
			id_field++;
	  }
	  function renderProperty(tipe , id){
		  $("#render"+id).load("<?php echo $this->renderUrl("formManagement","propertyField"); ?>/"+id+"/"+tipe);
	  }
	  function deleteField(id){
		  $("#id_"+id).remove();
	  }
	  </script>
      <?php }; /////////// End Buat tambah Form ?>
      <!-- /#page-wrapper --> 
    </div>
  </div>
</div>
<!-- /#wrapper -->
<?php $this->loadViewInclude("footer"); ?>
<script type="text/javascript">
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
<!-- DataTables JavaScript -->

	<?php //$this->loadAsset("js", "js/plugins/dataTables/jquery.dataTables.js",''); ?>
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.js",''); ?>    
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.bootstrap.js",''); ?>
    <script>
    $(document).ready(function() {
        $('#dataform').dataTable();
    });
    </script>
</body>
</html>
