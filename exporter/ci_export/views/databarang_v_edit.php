<html>
<head>
	<title>Data Barang</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
	<h1>EDIT Data Barang</h1>
	<?php foreach ($data_edit as $tes) {
		?>
		
		<form method="post" action="<?php echo base_url().'index.php/DataBarang/update/'.$tes->id ?>">
				

				<div class="form-group">
				<label>Nama Barang</label>
				<input type="text" class="form-control" required='required' name="namabarang1" value="<?php echo $tes->namabarang1 ?>">
				<p class="help-block"></p>
				</div>
				

				<div class="form-group">
				<label>Jumlah</label>
				<input type="number" class="form-control" required='required' name="jumlah2" value="<?php echo $tes->jumlah2 ?>">
				<p class="help-block"></p>
				</div>
				

				<input type="submit" value="Update" class="btn btn-primary">
		</form>
		<?php
	}
	?>
</body>
</html>