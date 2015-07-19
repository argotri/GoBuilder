<!DOCTYPE html>
<html lang="en">
<head>
<?php if($print!='print'){ ?>
<?php $this->loadViewInclude("head"); ?>
 <?php }; ?>
<title>Laporan - <?php echo NAMA_SISTEM ?></title>
<!-- DataTables CSS -->

    <?php 
	$this->loadAsset("css" , "css/plugins/dataTables.bootstrap.css",'');
	//$this->loadAsset("css" , "css/plugins/jquery.dataTables.css",'');
	?>
</head>

<body>
<?php if($print!='print'){ ?>
<div id="wrapper">
  <?php $this->loadViewInclude("navigator"); ?>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"><?php echo $detail_report['nama_laporan'] ?></h1>        
         <div class="panel panel-default">
         	<div class="panel-heading">
            <div>
            <form action="<?php $this->renderUrl('report','view',$id_report."/"); ?>">
            <input type="text" name="filter" placeholder="Search..." value="<?php echo $_GET['filter'] ?>">
           	<input type="submit" value="Cari" class="btn btn-primary btn-xs">
            	<a class="btn btn-primary btn-xs" href="<?php $this->renderUrl('report','view',$id_report.'/print/?filter='.$_GET['filter']); ?>" target="_blank"><i class="fa fa-print"></i> Print</a>
            </form>
            </div>
            </div>
            <div class="panel-body">
<?php } //////////////// End Print?>
				<h3><?php echo $detail_report['judul_laporan'] ?></h3>
                <?php if($detail_report['tipe_laporan'] == 'mendatar'){ ?>
                <table width="100%" border="1" cellpadding="5" cellspacing="0" class="table table-bordered">
                <thead> 
                <tr>
                <?php foreach($kolom_report as $value){ ?>
                	<th>
                    <b>
                    <?php echo $value['judul_kolom'] ?>
                    </b>
                    </th>
                 <?php }; ?>
                 </tr>
                </thead>
                <tbody>
                <?php if($isi_report!=NULL){ ?>
					<?php foreach($isi_report as $isinya){ /////// Digunakan untuk Looping Dataya ?>
                        <tr>
                        <?php foreach($kolom_report as $value){ ?>
							<?php if($value['fungsi']!=NULL)$fx_foot= true;////////////// Buat Mengecek apakah ada foot atau tidak ?>
                            <td><?php 
                            if(!is_numeric($isinya[$value['nama_kolom_tabel']])){
                                echo $isinya[$value['nama_kolom_tabel']]; 
                            }else{
                                echo number_format($isinya[$value['nama_kolom_tabel']]); 
                            }
                            if(is_numeric($isinya[$value['nama_kolom_tabel']])){
                                    $sum[$value['nama_kolom_tabel']] += $isinya[$value['nama_kolom_tabel']];
                            }
                            ?></td>
                         <?php }; ?>
                        </tr>
                      <?php } ?>
                  <?php }; ?>
                </tbody>
                <?php if($fx_foot){ ?>
                <tfoot>
                <tr>
                    <?php foreach($kolom_report as $value){ ?>
                    <td><?php 
						if($value['fungsi']!=NULL){
							switch($value['fungsi']){
								case "sum" :
								echo number_format($sum[$value['nama_kolom_tabel']]);
								break;
								case "average":
								echo number_format(round($sum[$value['nama_kolom_tabel']]/count($isi_report),5)). " (avg) ";
								break;
							}
						}
					?>
                    </td>
                    <?php }; ?>
                </tr>
                </tfoot>
                <?php }; ?>
                </table>
                <?php }; /// End Digunakan Jika Mendatar?>
                
<?php if($print!='print'){ //////////// MUlai Print ?>
            </div>
         </div>
         
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
	function load_kolom(){
		var id_form = $("#form").val();
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
<?php } ///////////////////////// End PRint?>
<?php if($print =='print'){ ?>
<script type="text/javascript">
window.print() ;
</script>
<?php }; ?>
</body>
</html>