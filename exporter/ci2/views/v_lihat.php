<html>
<head>
	<title>CARIKODE</title>
</head>
<body>
<h1>Data Buku</h1>
	<table border="1">
		<tr>			
			<th>judul</th>
			<th>pengarang</th>
			<th>kategori</th>
			<th>Opsi</th>
		</tr>
		<?php foreach($data_buku as $lihat){
		 ?>
		<tr>			
			<td><?php echo $lihat->judul; ?></td>
			<td><?php echo $lihat->pengarang; ?></td>
			<td><?php echo $lihat->kategori; ?></td>
			<td><?php echo anchor(base_url().'index.php/crud/hapus/'.$lihat->id,'hapus') ?>
			<?php echo anchor(base_url().'index.php/crud/edit/'.$lihat->id,'edit') ?></td>
		</tr>
		<?php 
	}
	?>
	<tr>
	<td><?php echo anchor(base_url().'index.php/crud/tambah','tambah');?></td>
	</tr>
</table>
</body>
</html>