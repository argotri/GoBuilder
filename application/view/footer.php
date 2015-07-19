
	<!-- jQuery Version 1.11.0 -->
	<?php $this->loadAsset('js','js/jquery-1.6.2.min.js')?>
	<?php $this->loadAsset('js','js/jquery-ui-1.8.16.custom.min.js')?>
    <!-- Bootstrap Core JavaScript -->
	<!--<script src="js/bootstrap.min.js"></script>-->
	<?php $this->loadAsset('js','js/bootstrap.min.js')?>
    <?php $this->loadAsset('js','js/bootstrap-tour.js'); ?>
    <!-- Metis Menu Plugin JavaScript -->
	<!--<script src="js/plugins/metisMenu/metisMenu.min.js"></script>-->
	<?php $this->loadAsset('js','js/plugins/metisMenu/metisMenu.min.js')?>
	<?php $this->loadAsset('js','js/fancybox/jquery.fancybox.pack.js')?>
    

    
    <!-- Custom Theme JavaScript -->
	<?php $this->loadAsset('js','js/sb-admin-2.js')?>

    
	<?php $this->loadAsset('js','js/js.js')?>
	<div id="dialog" style="display:none;"></div>
    <script type="text/javascript">
    	$(".fc_phone").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
		afterClose: function(){
            window.location.reload();
        }          
	});
	</script>
	<?php if(false){ ?>
    <div style="position:fixed;z-index:999;bottom:10px;margin:10px;background:#F8F8F8; width:220px;"> &copy; 2014 - 2015  <br>
	<a href="http://gosoft.web.id" target="_blank">Argo Triwidodo - Gobuilder </a></div>
	<?php }; ?>
    