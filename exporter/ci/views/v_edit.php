<html>
<head>
	<title>{title}</title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
	<h1>EDIT {title}</h1>
	<?php foreach ($data_edit as $tes) {
		?>
		
		<form method="post" action="<?php echo base_url().'{base_url}{controler}/update/'.$tes->id ?>">
				{isi_form}
				<input type="submit" value="Update" class="btn btn-primary">
		</form>
		<?php
	}
	?>
</body>
</html>