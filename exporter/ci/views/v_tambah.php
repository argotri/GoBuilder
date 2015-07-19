<html>
<head>
	<title>{title}</title>
<link rel="stylesheet" type="text/css" href="http://localhost/tugas_akhir/asset/css/bootstrap.min.css" />
</head>
<body style="padding:30px;">
<h1>Tambah {title}</h1>
	<form method="post" action="<?php echo base_url().'{base_url}{controler}/tambah_act' ?>">
		{isi_form}
		<input type="submit" class="btn btn-primary" value="submit"> 
	</form>
</body>
</html>