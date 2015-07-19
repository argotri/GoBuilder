<html>
<head>
	<title>{title}</title>
	 <link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
<h1>{title}</h1>
	<table border="1" class="table table-bordered">
		<tr>			
			{kolom_header}
			<th>Opsi</th>
		</tr>
		<?php foreach($data_tabel as $lihat){
		 ?>
		<tr>			
			{kolom_isi}
			<td><?php echo anchor(base_url().'{base_url}{controler}/hapus/'.$lihat->id,'hapus') ?>
			<?php echo anchor(base_url().'{base_url}{controler}/edit/'.$lihat->id,'edit') ?></td>
		</tr>
		<?php 
	}
	?>
	<tr>
	<td><?php echo anchor(base_url().'{base_url}{controler}/tambah','tambah');?></td>
	</tr>
</table>
</body>
</html>