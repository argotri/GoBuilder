<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Sistem Informasi - <?php echo NAMA_SISTEM ?></title>
<?php $this->loadAsset('css','css/bootstrap-tour.css'); ?>
<?php $this->loadViewInclude("head"); ?>
    <!-- Bootstrap Tour CSS -->
    
</head>


<body>

	<div id="wrapper">

		<?php $this->loadViewInclude("navigator"); ?>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header"><?php echo $judul ?> - Tambah Data</h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row col-lg-12" id="home">
				<div class="table-responsive">
                <form method="post" action="<?php echo $this->renderUrl("DataBarang2","tambah_data"); ?>">
               

				<div class="form-group">
				<label>Nama Barang</label>
				<input type="text" class="form-control" required='required' name="namabarang1" value="">
				<p class="help-block"></p>
				</div>
				

				<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" required='required' name="jumlah2" value="">
				<p class="help-block"></p>
				</div>
				

               <input type="submit" value="Tambah" class="btn btn-primary">
               </form>
                </div>
		  </div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->
</body>

</html>
