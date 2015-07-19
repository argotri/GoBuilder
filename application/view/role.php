<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title>Role Management - <?php echo NAMA_SISTEM ?></title>
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
            <h1 class="page-header">Role Management</h1>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        
		<div class="row">
        	<div class="panel panel-default">
           		<div class="panel-heading"> Role Management
                <div class="pull-right">
                <?php if($act != "view_form"){ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("role","insert",$id_role); ?>"><i class="fa fa-plus"></i> Insert Role</a>
                <?php }else{ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("role","",$id_role); ?>"><i class="fa fa-print"></i> View Data</a>
                <?php }; ?>
                </div>
                
                </div>
				<div class="panel-body">
                <?php if($act == "view_form"){ ?>
                <?php 
					if($aksi != 'editData'){
						$aksi = 'insertRole';
					}
				?>
                <form role="form" method="post" action="<?php echo $this->renderUrl("role",$aksi,$detailRole['id_role']); ?>">
					<div class="form-group">
                    	<label>Role Name</label>
                        <input type="text" class="form-control" name="nama_role" value="<?php echo $detailRole['nama_role'] ?>" >
                    </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
                 </form>
                 <?php }; ?>
                 
                 <?php if($act == "view_data"){ ?>
                 Pilih Role Untuk Menghilangkan Hak akses terhadap menu
                 
					<?php foreach($dataRole as $value){ ?>
                    
                    <div class="col-lg-12 role">
                    <a href="#!" onClick="loadRole('<?php echo $value['id_role'] ?>')">
                    	<div class="col-lg-8">
                        <?php echo $value['nama_role'] ?>
                        </div>
					</a>
                        <div class="col-lg-4">
						<a href="<?php echo $this->renderUrl("role","edit",$value['id_role']); ?>" title="Edit Role" onClick=""><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; 
                        
                        <a href="#!" title="Hapus Role" onClick="hapus_konfirm('<?php echo $value['nama_role']?>','#dialog','<?php echo $this->renderUrl("role","deleteRole",$value['id_role']); ?>');"><i class="fa fa-trash-o"></i></a>
                        </div>
				</div><!-- End View Role -->
                    <?php }; // End Role ?>
	           <!-- Digunakan Untuk Loading Rulenya -->
                <div id="role">
                
                </div>
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
	function loadRole(id_role){
		$("#role").load("<?php $this->renderUrl("role","loadMenu",""); ?>/"+id_role);
	}
</script>
</body>
</html>