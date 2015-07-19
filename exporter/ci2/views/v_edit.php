<html>
<head>
	<title>carikode</title>
</head>
<body>
	<h1>EDIT BUKU</h1>
	<?php foreach ($data_edit as $tes) {
		?>
		
		<form method="post" action="<?php echo base_url().'index.php/crud/update' ?>">
			<table>
				<tr>
					<td><input type="hidden" name="id" value="<?php echo $tes->id ?>"></td>
				</tr>
				<tr>
					<td>Judul</td><td><input type="text" name="judul" value="<?php echo $tes->judul ?>"></td>
				</tr>
				<tr>
					<td>Pengarang</td><td><input type="text" name="pengarang" value="<?php echo $tes->pengarang ?>"></td>
				</tr>
				<tr>
					<td>Kategori</td><td><input type="text" name="kategori" value="<?php echo $tes->kategori ?>"></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" value="Update" ></td>
				</tr>
			</table>
		</form>
		<?php
	}
	?>
</body>
</html>