<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title> User Management - <?php echo NAMA_SISTEM ?></title>
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
            <h1 class="page-header">User Management</h1>
          </div>
          <!-- /.col-lg-12 --> 
        </div>
        
		<div class="row">
        	<div class="panel panel-default">
           		<div class="panel-heading"> User Management
                <div class="pull-right">
                <?php if($act != "form"){ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("user","insert",''); ?>"><i class="fa fa-plus"></i> Insert Data</a>
                <?php }else{ ?>
                <a class="btn btn-primary btn-xs" href="<?php $this->renderUrl("user","",''); ?>"><i class="fa fa-print"></i> View Data</a>
                <?php }; ?>
                </div>
                
                </div>
				<div class="panel-body">
                <?php if($act == "form"){ ?>
                <?php 
					if($aksi != 'editData'){
						$aksi = 'insertData';
					}
				?>
                <form role="form" method="post" action="<?php echo $this->renderUrl("user",$aksi,$detail_user['id_user']); ?>">
					<div class="form-group">
                    <label>Nama User</label>
                    <input type="text" name="nama_user" class="form-control" required value="<?php echo $detail_user['nama_user'] ?>">
                    </div>
					<div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required value="<?php echo $detail_user['username'] ?>"> 
                    </div>
					<div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required value="<?php echo $detail_user['password'] ?>">
                    <input type="hidden" name="oldpassword" value="<?php echo $detail_user['password'] ?>">
                    </div>
					<div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="id_role">
                    <?php foreach($role as $value){ ?>
                    	<option value="<?php echo $value['id_role'] ?>" <?php echo ($value['id_role']==$detail_user['id_role'])?"selected":""; ?>><?php echo $value['nama_role'] ?></option>
					<?php }; ?>
                    </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Simpan">
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
                  <th>No</th>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Action</th>
                  </tr>
			<?php foreach($user as $value){ ?>
                 <tr>
                   <td><?php echo ++$i ?></td>
                   <td><?php echo $value['nama_user'] ?></td>
                   <td><?php echo $value['username'] ?></td>
                   <td><a href="<?php echo $this->renderUrl("user","edit",$value['id_user']); ?>" title="Edit Menu"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp; <a href="#!" title="Hapus Menu" onClick="hapus_konfirm('<?php echo $value['nama_user']?>','#dialog','<?php echo $this->renderUrl("user","deleteUser",$value['id_user']); ?>');"><i class="fa fa-trash-o"></i></a></td>
                 </tr>
			<?php }; ?>
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
 
</script>

</body>
</html>
<?php //var_dump(get_included_files()); ?>