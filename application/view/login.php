<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href='<?php $this->renderUrl('','','',''); ?>asset/gambar/icon.png' rel='icon' type='image/x-icon'/>
    <title>Login : <?php echo NAMA_SISTEM ?></title>

    <!-- Bootstrap Core CSS -->
    <?php $this->loadAsset("css","css/bootstrap.min.css"); ?>

    <!-- MetisMenu CSS -->
	<?php $this->loadAsset("css","css/plugins/metisMenu/metisMenu.min.css"); ?>
    <!-- Custom CSS -->
	<?php $this->loadAsset("css","css/sb-admin-2.css"); ?>
    <!-- Custom Fonts -->
    <?php $this->loadAsset("css","css/font-awesome-4.1.0/css/font-awesome.min.css"); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login <?php echo NAMA_SISTEM ?></h3>
                    </div>
                    <?php if(isset($_GET['gagal'])){?>
                    <script type="text/javascript"> 
						alert("login gagal , Username atau password Salah");
                    </script>
                    <?php }; ?>
                    <?php if(isset($_GET['logout'])){?>
                    <script type="text/javascript"> 
						alert("Anda Telah berhasil keluar dari sistem");
                    </script>
                    <?php }; ?>
                    <div class="panel-body">
                    <div style="padding-bottom:30px" align="center"><?php $this->loadAsset("img",'gambar/logo_gb.png','height="100px" id="gbr_logo" style="display:none;"'); ?></div>
                        <form role="form" action="<?php $this->renderUrl("login","doLogin") ?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" value="Login" class="btn btn-lg btn-outline btn-warning btn-block">
                            </fieldset>
                        </form><br>
<small>GoBuilder &copy; 2014 2015 <a href="http://gosoft.web.id" target="_blank">GoSoft - Argo Triwidodo</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
	<?php $this->loadAsset('js','js/jquery-1.11.0.js') ?>
    <!-- Bootstrap Core JavaScript -->
	<?php $this->loadAsset('js','js/bootstrap.min.js') ?>
    <!-- Metis Menu Plugin JavaScript -->
    <?php $this->loadAsset('js','js/plugins/metisMenu/metisMenu.min.js') ?>

    <!-- Custom Theme JavaScript -->
    <?php $this->loadAsset('js','js/sb-admin-2.js') ?>
	<script type="text/javascript">
	$("#gbr_logo").show(1000);
	</script>
</body>

</html>
