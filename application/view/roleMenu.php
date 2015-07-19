<div class="roleMenu">
<form method="post" action="<?php $this->renderUrl("role","roleEdit",$id_role); ?>">
Edit Forbiden Menu Untuk Role : <b><?php echo $detailRole['nama_role'] ?></b>
<?php foreach($menu as $mn){ ?>
<div class="form-group">
<label>
<?php 
$result = $plugin->in_array_r($mn['id_menu'], $menuRole);
?>
<input type="checkbox" <?php echo (!$result)?"checked":""; ?> name="<?php echo ++$i; ?>" value="<?php echo $mn['id_menu'] ?>">
<?php echo $mn['nama_menu'] ?>
</label>
</div>
<?php }; ?>
<small>Forbidden Menu adalah Membatasi Sebuah Role dengan Menu Tertentu, Yang tercetang Adalah Menu yang Tidak Tampil pada Role tersebut.</small><br>
<input type="submit" class="btn btn-primary" value="Simpan">
</form>
</div>