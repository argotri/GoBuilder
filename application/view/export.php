<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
.gambar{
	float:left;
	border:medium solid #D6F5D8;
	margin-left:10px;
}
.gambar:hover{
	background:#EDF5EE;
	border:solid medium #6E7BE5;
	cursor:pointer;
}
.selected{
	background:#EDF5EE;
	border:solid medium #6E7BE5;
}
</style>
<script type="text/javascript">
function p(tipe){
	$(".gambar:not(#"+tipe+")").removeClass("selected");
	$("#"+tipe).addClass("selected");
	$("#tp").val(tipe);
	$("#frm_detail").show();
	$("#txt_export").html(tipe.toUpperCase());	
}
</script>
</head>

<body>
Export form <b><?php echo $form['nama_form'] ?></b> Ke Framework Favorit anda
<hr>
<div align="center" style="width:600px;;margin:auto;">

    <div align="center" class="gambar" id="ci" onClick="p('ci')">
    <?php $this->loadAsset("img","gambar/ci_logo.png","height='128px'") ?>
    <br>
    </div>
    
    <div align="center" class="gambar" id="yii" onClick="p('yii')">
    <?php $this->loadAsset("img","gambar/yii_logo.png","height='128px'") ?>
    <br>
    </div>
    
    <div align="center" class="gambar" id="html" onClick="p('html')">
    <?php $this->loadAsset("img","gambar/html-logo.png","height='128px'") ?>
    <br>
    </div>    
	<br style="clear:both">
</div><br>
<form action="<?php $this->renderUrl("formManagement","exportForm"); ?>" method="post" target="_blank">
<input type="hidden" name="tipe" id="tp">
<input type="hidden" name="id_form" value="<?php echo $form['id_form'] ?>">
<input type="hidden" name="nama_tabel" value="<?php echo $form['nama_tabel'] ?>">
<table width="400" align="center" id="frm_detail" style="display:none">
  <tbody>
    <tr>
      <td>Export Ke</td>
      <td id="txt_export"></td>
    </tr>
    <tr>
      <td>Nama Model</td>
      <td>
      <input type="text" name="model" required ></td>
    </tr>
    <tr>
      <td>Nama Controler</td>
      <td><input type="text" name="controler" required ></td>
    </tr>
    <tr>
      <td>Nama Tabel</td>
      <td><input type="text" name="tabel" required ></td>
    </tr>
    <tr>
      <td>Base URL</td>
      <td><input type="text" name="base_url"  ></td>
    </tr>
    
    <tr>
      <td colspan="2">
      <small>
      *Base URL ini digunakan apakah anda menggunakan .htacess atau tidak , jika menggunakan .htacess (urlnya tanpa index.php ex http://web.com/controler/fungsi) silahkan dikosongkan . Jika tidak menggunakan , silahkan masukkan urlnya (index.php atau menurut routernya).
      </small>
      </td>
      </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" class="btn btn-primary btn-outline" value="Export"></td>
    </tr>
  </tbody>
</table>
</form>
</body>
</html>
