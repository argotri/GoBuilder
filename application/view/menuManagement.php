<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title>Menu Management-<?php echo NAMA_SISTEM ?></title>
<!-- DataTables CSS -->
    <?php 
	$this->loadAsset("css" , "css/plugins/dataTables.bootstrap.css",'');
	?>
</head>

<body>
<script type="text/javascript">

</script>

<div id="wrapper">
  <?php $this->loadViewInclude("navigator"); ?>
  <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1 class="page-header">Menu Management</h1>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        
		<div class="row">
        	<div class="panel panel-default">
           		<div class="panel-heading"> Manage Menu
                <div class="pull-right">
                <?php if($act != "view_form"){ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("menuManagement","insertData"); ?>"><i class="fa fa-plus"></i> Insert Menu</a>
                <?php }else{ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("menuManagement",""); ?>"><i class="fa fa-print"></i> View Menu</a>
                <?php }; ?>
                </div>
                
                </div>
				<div class="panel-body">
                <?php if($act == "view_form"){ ?>
                <?php 
					if($aksi != 'editDataMenu'){
						$aksi = 'insertDataMenu';
					}
				?>
                <form role="form" method="post" action="<?php echo $this->renderUrl("menuManagement",$aksi,$id_menu); ?>">
                <div class="form-group">
                	<label>Nama Menu</label>
                    <input type="text" value="<?php echo $detail_menu['nama_menu']?>" name="nama_menu" class="form-control" required placeholder="Masukkan Nama Menu Disini.">
                    
                </div>
                <div class="form-group">
                <label>Tipe Menu</label>
                <select id="tipe_menu" class="form-control">
                  <option value="form" <?php echo ($detail_menu['id_form']!=NULL)?"selected":""; ?>>Form</option>
                  <option value="report" <?php echo ($detail_menu['id_laporan']!=NULL)?"selected":""; ?>>Laporan / Report</option>         	
                </select>
                </div>
                <div id="formKolom">
                
                </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                 </form>
                 <?php }; ?>
                 <?php if($act == "view_data"){ ?>
                 <?php
                 //var_dump($form);
				 ?>
                 <div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover dataTable no-footer" >
                 <tr>
                      <th>No</th>
                      <th>Nama Menu</th>
                      <th>Tipe Menu</th>
                      <th>Action</th>
                  </tr>
                  <?php foreach($dataMenu as $listmenu){ ?>
                  <tr>
                      <td><?php echo ++$i ?></td>
                      <td><?php echo $listmenu['nama_menu'] ?></td>
                      <td><?php echo ($listmenu['id_form']!=NULL)?"Form":"Report / Laporan"; ?></td>
                      <td><a href="<?php echo $this->renderUrl("menuManagement","edit",$listmenu['id_menu']); ?>" title="Edit Menu"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a href="#!" title="Hapus Menu" onClick="hapus_konfirm('<?php echo $listmenu['nama_menu'] ?>','#dialog','<?php echo $this->renderUrl("menuManagement","deleteMenu",$listmenu['id_menu']); ?>');"><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <?php }; ?>
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

    <script>
	function load_opsi(){
		var tipe = $("#tipe_menu").val();
		$("#formKolom").load("<?php $this->renderUrl("menuManagement","listOpsi"); ?>/"+tipe+"/<?php echo $detail_menu['id_form'] ?><?php echo $detail_menu['id_laporan'] ?>");
	}
	$(document).ready(function(e) {
		<?php if($act == "view_form"){ ?>
        load_opsi();
		<?php }; ?>
    });
	$("#tipe_menu").change(function(e) {
        load_opsi();
    });
	</script>
</body>
</html>
<?php //var_dump(get_included_files()); ?>