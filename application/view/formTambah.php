<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tambahkan Form</title>
</head>

<body>
<?php if($form){?>
<script type="text/javascript">
alert("Form Berhasil Dibuat");
window.location="<?php echo $this->renderUrl("formManagement"); ?>";
</script>
<?php }; ?>
</body>
</html>