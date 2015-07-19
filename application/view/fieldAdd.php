<div class="col-lg-10">
<select name="field[<?php echo $id ?>][tipe]" id="select" class="form-control" onChange="renderProperty($(this).val(),<?php echo $id ?>)">
  <option>Pilih Tipe</option>
  <option value="text">Text</option>
  <option value="number">Number</option>
  <option value="text_area">Text Area</option>
  <option value="select">Drop Down(Select)</option>
  <option value="date">Date</option>
  <option value="file">File / Image</option>
  <option value="bool">Boolean (Benar/Salah)</option>
  <option value="check">Check Box</option>
</select>
</div>
<div class="col-lg-2">
<div class="pull-right">
<a href="#!" onClick="deleteField(<?php echo $id ?>)">
<?php $this->loadAsset('img' , 
'gambar/delete.png',"width='32'"); ?>
</a>
</div>
</div>
<div id="render<?php echo $id ?>" class="form-group col-lg-12"></div>
