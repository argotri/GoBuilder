<div class="form-group">
<label>List Kolom </label><br>
<small>Drag Untuk Mengatur Posisi , Beri tanda Centang Untuk menampilkan dalam Laporan / Report</small>
<div style="padding:10px;border:#000 thin solid;">
<div class="col-lg-12">
<div class="col-lg-4">Field </div>
<div class="col-lg-4">Judul Field</div>
<div class="col-lg-4">Opsi Tambahan , Ditampilkan di footer Report</div>
</div>
<div id="sort">
<?php foreach($detail_field as $kolom){ ?>
<div class="col-lg-12 form_field">
<div class="col-lg-4">
<?php 
//if($detail_kolom == NULL){
	$cheked = "checked";
//}
?>
<input name="kolom[<?php echo ++$i; ?>]" type="checkbox" value="<?php echo $kolom['nama_field'] ?>"  <?php echo $cheked ?>> <?php echo $kolom['text'] ?>
</div>
<div class="col-lg-4">
<input type="text" name="field_judul[<?php echo $i ?>]" value="<?php echo $kolom['text'] ?>">
</div>
<div class="col-lg-4">
<?php if(trim($kolom['tipe'])=="number"){ ?>
<select name="opsi[<?php echo $i ?>]">
<option value="">None</option>
<option value="average">Rata - Rata</option>
<option value="sum">Total / Summary</option>
</select>
<?php }; ?>
</div>
 </div>
<?php }; ?>
</div> <!-- End Sortable-->
<br style="clear:both;">
</div>
</div>
<input type="hidden" name="nama_tabel" value="<?php echo $detail_form['detail_form']['nama_tabel'] ?>">
<script>
    $(document).ready(function() {
		$( "#sort" ).sortable({
			revert: true,
			update:function (event, ui) {
				var data = $(this).sortable('serialize');
			}
		});
    });
</script>