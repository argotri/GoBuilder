<html>
<head>
	<title>Data Barang</title>
<link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
<h1>Tambah Data Barang</h1>
	<form method="post" action="<?php echo base_url().'index.php/DataBarang/tambah_act' ?>">
		

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
				

		<input type="submit" class="btn btn-primary" value="submit"> 
	</form>
</body>
</html>