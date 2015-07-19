<html>
<head>
	<title>carikode</title>
</head>
<body>
<h1>Tambah BUKU</h1>
	<form method="post" action="<?php echo base_url().'index.php/crud/tambah_act' ?>">
		<table>
			<tr>
				<td>Judul</td><td><input type="text" name="judul"></td>
			</tr>
			<tr>
				<td>Pengarang</td><td><input type="text" name="pengarang"></td>
			</tr>
			<tr>
				<td>Kategori</td><td><input type="text" name="kategori"></td>
			</tr>
			<tr>
				<td></td><td><input type="submit" value="input"></td>
			</tr>
		</table>
	</form>
</body>
</html>