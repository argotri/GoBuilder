
<?php 
	switch($tipe){ 
		case "text":
		?>
<table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" class="form-control" required></td>
  </tr>
  <tr>
    <td><input type="text" value="Contoh Input" disabled class="form-control"></td>
  </tr>
    <tr>
    <td>
    <div class="checkbox">
    <label>
    <input type="checkbox" name="field[<?php echo $id ?>][wajib]"> Field Wajib Diisi
    </label>
    </div>
    </td>
  </tr>
</table>

<?php
	break; // End Text Biasa
	case "text_area":
	?>
<table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" required class="form-control" ></td>
  </tr>
  <tr>
    <td>
    <textarea class="form-control" disabled>Contoh Input</textarea>
    </td>
  </tr>
    <tr>
    <td>
    <div class="checkbox">
    <label>
    <input type="checkbox" name="field[<?php echo $id ?>][wajib]"> Field Wajib Diisi
    </label>
    </div>
    </td>
  </tr>
</table>
<?php
	break;
	case "select":
?>
<table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" required class="form-control" ></td>
  </tr>
  <tr>
    <td>
		<select disabled class="form-control">
        	<option>Contoh Input</option>
        </select>
    </td>
  </tr>
  <tr>
  	<td>Tipe Select </td>
  </tr>   
  <tr>
  	<td>
    <select name="field[<?php echo $id ?>][tipe_select]" id="tipe<?php echo $id ?>" onChange="gantiTipe<?php echo $id ?>()" class="form-control">
  	  <option value="statis">Statis</option>
  	  <option value="dinamis">Dinamis - Dari Form Lain</option>
  	</select>
    </td>
  </tr>   
  <tr id="opsi_statik<?php echo $id ?>">
  	<td>Tambahkan Opsi</td>
  </tr>
  <tr id="opsi_statik1<?php echo $id ?>">
  	<td><input type="text" id="opsi<?php echo $id ?>"><button type="button" onClick="tambah_propertyselect<?php echo $id ?>()">Tambahkan</button>
    <script type="text/javascript">
	var d<?php echo $id ?> = 0;
	function tambah_propertyselect<?php echo $id ?>(){
		var data = $("#opsi<?php echo $id ?>").val();
		$("#opsi<?php echo $id ?>").val("");
		$("#lista<?php echo $id ?>").append("<li id='list<?php echo $id ?>"+d<?php echo $id ?>+"'><a onclick='deleteproperty_select<?php echo $id ?>("+d<?php echo $id ?>+")' href='#!'>"+data+"</a></li>");
		$("#hidden<?php echo $id ?>").append("<input id='property_select<?php echo $id ?>_"+d<?php echo $id ?>+"' type='hidden' name='field[<?php echo $id ?>][property_select]["+d<?php echo $id ?>+"]' value='"+data+"'>");
		d<?php echo $id ?>++;
	}
	function deleteproperty_select<?php echo $id ?>(id_select){
		$("#list<?php echo $id ?>"+id_select).remove();
		$("#property_select<?php echo $id ?>_"+id_select).remove();
	}
</script>
    </td>
  </tr>
  <tr id="opsi_statik2<?php echo $id ?>">
  	<td>
    <ul id="lista<?php echo $id ?>">
    </ul>
    <small>*Click To Remove</small>
    <span id="hidden<?php echo $id ?>" style="display:none;">
    </span>
    </td>
  </tr>
  <tr id="opsi_dinamis<?php echo $id ?>">
  	<td>Pilih Form</td>
  </tr>
  <tr id="opsi_dinamis1<?php echo $id ?>">
  	<td>
    <select id="opsi_tabel<?php echo $id ?>" class="form-control" name="field[<?php echo $id ?>][nama_tabel]" onChange="load_select<?php echo $id ?>()">
    	<?php for($i=0;$i<count($listForm);$i++){ ?>
			<option value="<?php echo $listForm[$i]['nama_tabel'] ?>"><?php echo $listForm[$i]['nama_form'] ?></option>
        <?php }; ?>
    </select>
    </td>
  </tr>
  <tr id="opsi_field<?php echo $id ?>">
  	<td>
    <div>Pilih Value</div>
    <select class="form-control" name="field[<?php echo $id ?>][nama_value]" id="opsi_fielddata<?php echo $id ?>">
    </select>
    </td>
  </tr>
</table>

<script type="text/javascript">
function gantiTipe<?php echo $id ?>(){
	var tipe = $("#tipe<?php echo $id ?>").val();
	if(tipe == 'dinamis'){
		$("#opsi_dinamis<?php echo $id ?>").show();
		$("#opsi_dinamis1<?php echo $id ?>").show();
		$("#opsi_field<?php echo $id ?>").show();
		$("#opsi_statik<?php echo $id ?>").hide();
		$("#opsi_statik1<?php echo $id ?>").hide();
		$("#opsi_statik2<?php echo $id ?>").hide();
	}else{
		$("#opsi_dinamis<?php echo $id ?>").hide();
		$("#opsi_dinamis1<?php echo $id ?>").hide();
		$("#opsi_field<?php echo $id ?>").hide();
		$("#opsi_statik<?php echo $id ?>").show();
		$("#opsi_statik1<?php echo $id ?>").show();
		$("#opsi_statik2<?php echo $id ?>").show();
	}
}
function load_select<?php echo $id ?>(){
	var id_form = $("#opsi_tabel<?php echo $id ?>").val();
	/// Load ajax Select jsson
	$("#opsi_fielddata<?php echo $id ?>").load();
	$.ajax({
		url:"<?php echo $this->renderUrl("formManagement","propertyForm"); ?>/"+id_form,
		type:"GET",
		dataType: 'json',
		success: function( json ) {
			$('#opsi_fielddata<?php echo $id ?>').find('option').remove();  
			$.each(json, function(i, value) {
				$('#opsi_fielddata<?php echo $id ?>').append($('<option>').text(value.nama_label).attr('value', value.kolom));
			});
		}
	});
}
gantiTipe<?php echo $id ?>();
load_select<?php echo $id ?>();
</script>

<?php
	break;
	case "number":
	?>
<table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" class="form-control" required></td>
  </tr>
  <tr>
    <td><input type="Number" value="12345" disabled class="form-control"></td>
  </tr>
  <tr>
    <td>
    <div class="checkbox">
    <label>
    <input type="checkbox" name="field[<?php echo $id ?>][wajib]"> Field Wajib Diisi
    </label>
    </div>
    </td>
  </tr>
</table> 

<?php
	break;
	case "date":
	?>
    <table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" class="form-control" required></td>
  </tr>
  <tr>
    <td><input type="text" value="<?php echo  date("Y-m-d"); ?>" disabled class="form-control"></td>
  </tr>
    <tr>
    <td>
    <div class="checkbox">
    <label>
    <input type="checkbox" name="field[<?php echo $id ?>][wajib]"> Field Wajib Diisi
    </label>
    </div>
    </td>
  </tr>
</table>
<?php
	break;
	case "bool":
	?>
    <table width="100%" >
  <tr>
    <td><input id="bool-text-<?php echo $id ?>" type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" class="form-control" required  onKeyUp="renderBool<?php echo $id ?>()"></td>
  </tr>
  <tr>
    <td>
    <div class="checkbox" id="bool-pre<?php echo $id ?>" style="display:none">
    <label>
    <input type="checkbox" disabled><span id="bool-<?php echo $id ?>"></span>
    </label>
    </div>
    </td>
  </tr>
<script type="text/javascript">

	function renderBool<?php echo $id ?>(){
		var txt = $("#bool-text-<?php echo $id ?>").val();
		$("#bool-<?php echo $id ?>").html(txt);
		if(txt.length > 0 ){
			$("#bool-pre<?php echo $id ?>").show();
		}else{
			$("#bool-pre<?php echo $id ?>").hide();
		}
	}

</script>
</table>
<?php
	break;
	case "file":
	?>
    <table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" class="form-control" required></td>
  </tr>
  <tr>
    <td><input type="file"  disabled ></td>
  </tr>
  <tr>
    <td>
    Tipe file : 
    <select name="field[<?php echo $id ?>][filter]" class="form-control">
      <option value="image/jpeg,image/gif,image/png,image/*">Image</option>
	  <option value=" application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/vnd.ms-powerpoint,application/pdf">Dokumen Office</option>
	  <option value="*">Other</option>
    </select></td>
  </tr>
</table>
    <?php
	break;
	case "check":
?>
<table width="100%" >
  <tr>
    <td><input type="text" name="field[<?php echo $id ?>][label]" placeholder="Masukkan Label Text" required class="form-control" ></td>
  </tr>
  <tr>
    <td>
		<input type="checkbox" disabled> Contoh Input<br>
		<input type="checkbox" disabled> Contoh Input
    </td>
  </tr>  
  <tr id="opsi_statik<?php echo $id ?>">
  	<td>Tambahkan Opsi</td>
  </tr>
  <tr id="opsi_statik1<?php echo $id ?>">
  	<td><input type="text" id="opsi<?php echo $id ?>"><button type="button" onClick="tambah_propertycek<?php echo $id ?>()">Tambahkan</button>
    <script type="text/javascript">
	var d<?php echo $id ?> = 0;
	function tambah_propertycek<?php echo $id ?>(){
		var data = $("#opsi<?php echo $id ?>").val();
		$("#opsi<?php echo $id ?>").val("");
		$("#lista<?php echo $id ?>").append("<li id='list"+d<?php echo $id ?>+"'><a onclick='deleteproperty_cek<?php echo $id ?>("+d<?php echo $id ?>+")' href='#!'>"+data+"</a></li>");
		$("#hidden<?php echo $id ?>").append("<input id='property_cek<?php echo $id ?>_"+d<?php echo $id ?>+"' type='hidden' name='field[<?php echo $id ?>][property_cek]["+d<?php echo $id ?>+"]' value='"+data+"'>");
		d<?php echo $id ?>++;
	}
	function deleteproperty_cek<?php echo $id ?>(id_select){
		$("#list"+id_select).remove();
		$("#property_select<?php echo $id ?>_"+id_select).remove();
	}
</script>
    </td>
  </tr>
  <tr id="opsi_statik2<?php echo $id ?>">
  	<td>
    <ul id="lista<?php echo $id ?>">
    </ul>
    <small>*Click To Remove</small>
    <span id="hidden<?php echo $id ?>" style="display:none;">
    </span>
    </td>
  </tr>
</table>
<?php
	break;
	}
?>
