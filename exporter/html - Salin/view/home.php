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
					<h1 class="page-header"><?php echo $judul ?></h1>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->
			<div class="row col-lg-12" id="home">
				<div class="table-responsive">
                <a href="<?php echo $this->renderUrl("{controler}","tambah"); ?>" class="btn btn-success btn-outline"><i class="fa fa-plus"></i> Tambah</a>
                	<table width="100%" border="0" class="table table-bordered table-hover" id="data_table">
                        <thead>
                          <tr>
                            <!--
                              <th >ID</th>
                              <th >Kolom1</th>
                              <th >Kolom2</th>-->
                              {kolom_header}
                            <th >#</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php foreach($db as $v){ ?>
                          <tr>

                            <!--<td ><?php echo $v['id'] ?></td>
                            <td ><?php echo $v['namabarang1'] ?></td>
                            <td ><?php echo $v['statusbarang2'] ?></td>-->
                            {kolom_isi}
                            <td ><a href="<?php echo $this->renderUrl("{controler}","edit",$v['id']); ?>"><i class="fa fa-pencil"></i></a>&nbsp; &nbsp;<a href="<?php echo $this->renderUrl("{controler}","delete",$v['id']) ?>"> <i class="fa fa-times"></i></a></td>
                          </tr>
                          <?php }; ?>
                        </tbody>
                    </table>

                </div>
		  </div>
			<!-- /.row -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->
</body>

</html>
