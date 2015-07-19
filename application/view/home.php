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
					<h1 class="page-header"></h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row" id="home">
				<h1 align="center"> Selamat Datang Di Sistem Informasi <?php echo NAMA_SISTEM ?> </h1>
                <h4 align="center"><a href="#!" class="btn btn-primary" id="startTour">Start Tour </a></h4>
                <div align="center"><?php $this->loadAsset("img",'gambar/logo_gb.png'); ?></div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->
	<?php $this->loadViewInclude("footer"); ?>
	<!-- Bootstrap Tour -->
    <script type="text/javascript">
	$("#startTour").click(function(e) {
    	var tour = new Tour();    
		tour.addSteps([
		{
				element: "#home",
				title: "Selamat Datang Di Sistem Informasi",
				content: "Disini anda dapat membuat Sistem informasi Tanpa Melakukan Coding",
				placement : "bottom"
		}
		]);
		tour.addSteps([
		    {
				element: "#formMN",
				title: "Form",
				content: "Menu ini Digunakan untuk melihat , mengedit dan mengisi serta menghapus isi Form yang telah diinputkan "
			  }
		]);
		tour.addSteps([
		      {
				element: "#report",
				title: "Report",
				content: "Menu ini Digunakan untuk melihat laporan serta mencetak Laporan"
			  }
		]);
		<?php if($_SESSION['role'] == 0 ){ ?>
		tour.addSteps([
		      {
				element: "#formManagement",
				title: "Form Management",
				content: "Menu ini Digunakan untuk Membuat Form sesuai dengan yang anda Butuhkan"
			  }
		]);
		tour.addSteps([
		      {
				element: "#reportManagement",
				title: "Report Management",
				content: "Setelah Form Dibuat , Maka anda dapat membuat Report yang akan dicetak oleh user lain"
			  }
		]);
		tour.addSteps([
		      {
				element: "#menuManagement",
				title: "Menu Management",
				content: "Anda dapat membuat Menu yang nantinya dapat menuju ke form atau Report yang anda Buat sebelumnya"
			  }
		]);
		tour.addSteps([
		      {
				element: "#userManagement",
				title: "User Management",
				content: "Amankan sistem anda dengan Kendali 1 orang 1 user , Buat user anda disini "
			  }
		]);
		tour.addSteps([
		      {
				element: "#roleManagement",
				title: "Role Management",
				content: "Disini anda dapat Membuat aturan untuk membatasi hak akses terhadap report dan Form yang anda buat"
			  }
		]);
		tour.addSteps([
		      {
				element: "#home",
				title: "Selesai",
				content: "Sekarang Anda Telah Menyelesaikan Tour ini , Selamat Membuat Sistem informasi anda sendiri ^_^.",
				placement : "bottom"
			  }
		]);
		<?php }; ?>
		tour.restart();
    });
	
			
			
			
			// Initialize the tour
			//tour.init();
			
			// Start the tour

	</script>
</body>

</html>
