<div class="form-group">
<?php if($pilihan=="form"){ ?>
<label>Pilih Form</label>
<select name="id_form" class="form-control">
<?php foreach($form as $value){ ?>
	<option value="<?php echo $value['id_form'] ?>" <?php echo ($id_pilihan==$value['id_form'])?"selected":""; ?>><?php echo $value['nama_form'] ?></option>
<?php }; ?>
</select>
<?php }else{ ?>
<label>Pilih Report</label>
<select name="id_laporan" class="form-control">
<?php foreach($report as $value){ ?>
	<option value="<?php echo $value['id_laporan'] ?>" <?php echo ($id_pilihan==$value['id_laporan'])?"selected":""; ?>><?php echo $value['nama_laporan'] ?></option>
<?php }; ?>
</select>
<?php }; ?>
</div>