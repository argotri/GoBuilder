<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->loadViewInclude("head"); ?>
<title>Report Management -<?php echo NAMA_SISTEM ?></title>
<!-- DataTables CSS -->
    <?php 
	$this->loadAsset("css" , "css/plugins/dataTables.bootstrap.css",'');
	//$this->loadAsset("css" , "css/plugins/jquery.dataTables.css",'');
	?>
</head>

<body>
<div id="wrapper">
  <?php $this->loadViewInclude("navigator"); ?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Report Management </h1>        
	<?php if($aksinya == "view"){ ?>    
        <div class="panel panel-default">
        	<div class="panel-heading"><i class="fa fa-print">&nbsp;</i>List Report 
			<!-- Buat menu samping -->
            <div class="pull-right">
              <a href="<?php $this->renderUrl("reportManagement","tambah"); ?>" class="btn btn-default btn-xs "><i class="fa fa-plus-square fa-fw"></i>Tambahkan Report</a>
              </div><!-- End menu Samping-->
            </div><!-- End Panel Heading -->
            <div class="panel-body">
				<div class="table-responsive">
                <?php //var_dump($report); ?>
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="datareport">
                    <thead>
                	    <tr > 
                        	<td>No.</td>
                        	<td>Nama Laporan</td>
                        	<td>Judul Laporan</td>
                        	<td>Tanggal Create</td>
                        	<td>User Create</td>
                        	<td>Aksi</td>
                    	</tr>
                    </thead>
                    <tbody>
                    <?php if($report !=NULL){ ?>
                    <?php foreach($report as $isi_report){ ?>
                	    <tr >
                	      <td><?php echo ++$i ?></td>
                	      <td><?php echo $isi_report['nama_laporan']; ?></td>
                	      <td><?php echo $isi_report['judul_laporan']; ?></td>
                	      <td><?php echo $isi_report['tgl_create']; ?></td>
                	      <td><?php echo $isi_report['user_create']; ?></td>
                	      <td><a title="Cetak / View Laporan " href="<?php echo $this->renderUrl("report","view",$isi_report['id_laporan']); ?>"><i class="fa fa-print"></i></a>
                          <a title="Edit Laporan " href="<?php echo $this->renderUrl("reportManagement","edit",$isi_report['id_laporan']); ?>"><i class="fa fa-pencil"></i></a>
						  <a title="Hapus Laporan " href="#!" onClick="hapus_konfirm('<?php echo $isi_report['nama_laporan']; ?>' , '#dialog','<?php echo $this->renderUrl("reportManagement","delete",$isi_report['id_laporan']); ?>')"><i class="fa fa-trash-o"></i></a>
                          </td>
              	      </tr>
					<?php };}; // End if End Foreach ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div><!-- End Panel-->
		<?php }; /// End View ?>
        
        <?php 
		///////////////////////// Digunakan Untuk Menambahkan Report Builder
		if($aksinya=="viewForm"){
			if(count($listForm)>0){
				//var_dump($detail_report);
		 ?>
         <form action="<?php $this->renderUrl('reportManagement',$act,$detail_report['id_laporan']) ?>" method="post">
         <div class="panel panel-default">
         	<div class="panel-heading">
			<input class="title_form" type="text" name="nama_report" required placeholder="Inputkan Nama Report anda" value="<?php echo $detail_report['nama_laporan'] ?>">
                 <div class="pull-right">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-save"></i> Save Report</button>
                  </div>
                </div>
            </div>
            <div class="panel-body">
            	<div class="form-group">
                <label>Judul Report</label>
                <input type="text" name="judul_report" required placeholder="Judul Report" class="form-control" value="<?php echo $detail_report['judul_laporan'] ?>">
                </div>
                
            	<div class="form-group">
                <label>Pilih Form</label>
				<select class="form-control" name="table" required id="form_kolom" onChange="load_kolom()">
				 <option value="">--- Pilih Form ---</option>
                <?php foreach($listForm as $form){ ?>
				  <option value="<?php echo $form['id_form'] ?>" <?php echo ($form['id_form']==$detail_report['id_form'])?"selected":""; ?>><?php echo $form['nama_form'] ?></option>
				<?php }; ?>
                </select>
                </div>
            	<div class="form-group" id="load_kolom">
                	
                </div>
              <div class="form-group">
                <label>Tipe Report</label>
                <div class="row">
                <div class="col-lg-6">
					<label><input name="tipe" type="radio" value="mendatar" checked="checked"> <?php $this->loadAsset('img','gambar/kebawah.png'); ?></label>
                </div>
                <?php if(false){ ?>
				<div class="col-lg-6">
					<label><input type="radio" name="tipe" value="menyamping"> <?php $this->loadAsset('img','gambar/kesamping.png'); ?></label>
                </div>
                  <?php }; ?>
				<br style="clear:both;">
                </div><!-- End COl LG 12-->
                </div>
            </div>
         </div>
         </form>
         <?php }else{ // End Jika Jumlah Form tidak dengan 0?>
         <script type="text/javascript">
		 	alert("Mohon Maaf , Belum ada Form yang dibuat , \nanda harus membuat form terlebih dahulu di Menu Form Management\nTerima Kasih");
		 </script>
         <?php }; // End Jika Jumlah Form sama dengan 0 ?>
         <?php }; // end buat tambah report ?>
      </div>
      <!-- /.col-lg-12 --> 
    </div>
  </div><!-- End page-wrapper -->
</div>
<!-- /#wrapper -->
<?php $this->loadViewInclude("footer"); ?>
	<?php //$this->loadAsset("js", "js/plugins/dataTables/jquery.dataTables.js",''); ?>
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.js",''); ?>    
	<?php $this->loadAsset("js", "js/plugins/dataTables/dataTables.bootstrap.js",''); ?>
    <script>
	<?php //var_dump($detail_report); ?>
	function load_kolom(){
		var id_form = $("#form_kolom").val();
		$("#load_kolom").load("<?php $this->renderUrl("reportManagement","loadKolom",''); ?>"+"/"+id_form+"/<?php echo $detail_report['id_laporan'] ?>");
	}
	$("#form").change(function(e) {
		load_kolom();
    });
	 $(document).ready(function() {
        $('#datareport').dataTable();
		<?php if($act == 'editReport'){ ?>
			load_kolom();		
		<?php }; ?>
    });
    </script>
</body>
</html>