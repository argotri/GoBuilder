<html>
<head>
	<title></title>
	 <link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
<h1></h1>
	<table border="1" class="table table-bordered">
		<tr>			
			<th>id</th><th>Nama Barang</th><th>Jumlah</th>
			<th>Opsi</th>
		</tr>
		<?php foreach($data_tabel as $lihat){
		 ?>
		<tr>			
			<td><?php echo $lihat->id;?></td><td><?php echo $lihat->namabarang1;?></td><td><?php echo $lihat->jumlah2;?></td>
			<td><?php echo anchor(base_url().'index.php/DataBarang/hapus/'.$lihat->id,'hapus') ?>
			<?php echo anchor(base_url().'index.php/DataBarang/edit/'.$lihat->id,'edit') ?></td>
		</tr>
		<?php 
	}
	?>
	<tr>
	<td><?php echo anchor(base_url().'index.php/DataBarang/tambah','tambah');?></td>
	</tr>
</table>
</body>
</html>