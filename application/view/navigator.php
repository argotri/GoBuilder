<!-- Navigation -->

<nav class="navbar navbar-default navbar-static-top" role="navigation"
			style="margin-bottom: 0">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span> </button>
    <a class="navbar-brand" href="<?php $this->renderUrl('home','',''); ?>"><?php $this->loadAsset("img",'gambar/logo_gb.png','height="30px"'); ?> Welcome <?php echo $_SESSION['user_detail']['nama_user'] ?></a> </div>
  <!-- /.navbar-header -->
  
  <ul class="nav navbar-top-links navbar-right">
    <!-- Start User Profile -->
    <li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i
						class="fa fa-caret-down"></i> </a>
      <ul class="dropdown-menu dropdown-user">
        <li id="userProfil"><a data-fancybox-type="iframe"  class="fc_phone" href="<?php $this->renderUrl('user','userProfil'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>
        <li class="divider"></li>
        <li><a href="<?php $this->renderUrl('login','logout');?>"><i
								class="fa fa-sign-out fa-fw"></i> Logout</a></li>
      </ul>
      <!-- /.dropdown-user --></li>
    <!-- /.dropdown -->
  </ul>
  <!-- /.navbar-top-links -->
  
  <div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
      <ul class="nav" id="side-menu">
        <?php if(false){ ?>
        <li class="sidebar-search">
          <div class="input-group custom-search-form">
            <input type="text" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
          <!-- /input-group --> 
        </li>
        <?php }; ?>
        <li><a class="active" href="<?php echo $this->url(); ?>" id="dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a></li>
        <li id="formMN"> <a href="#"><i class="fa fa-save fa-fw"></i> Form <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
          <?php //var_dump($_SESSION['menu']); ?>
	         <?php if($_SESSION['menu']['form'] != NULL){ 
			 		foreach($_SESSION['menu']['form'] as $menuform){
			 ?>
            <li> <a href="<?php $this->renderUrl("form","viewData",$menuform['id_form']); ?>"><i class="fa fa-paper-plane fa-fw"></i><?php echo $menuform['nama_menu'] ?></a> </li>
            <?php }} ?>
          </ul>
          <!-- /.nav-second-level --> 
        </li>
        
        <li id="report"> <a href="#"><i class="fa fa-print fa-fw"></i> Report <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
	         <?php if($_SESSION['menu']['report'] != NULL){ 
			 		foreach($_SESSION['menu']['report'] as $menuform){
			 ?>
            <li> <a href="<?php $this->renderUrl("report","view",$menuform['id_laporan']); ?>"><i class="fa fa-paper-plane fa-fw"></i><?php echo $menuform['nama_menu'] ?></a> </li>
            <?php }} ?>
          </ul>
          <!-- /.nav-second-level --> 
        </li>
        <?php if($_SESSION['role'] == 0){ ?>
        <li id="formManagement"> <a href="<?php $this->renderUrl("formManagement"); ?>"><i class="fa fa-file fa-fw"></i> Form Management</a></li>
        <li id="reportManagement"> <a href="<?php $this->renderUrl("reportManagement"); ?>"><i class="fa fa-print fa-fw"></i> Report Management</a></li>
		<li id="menuManagement"> <a href="<?php $this->renderUrl("menuManagement"); ?>"><i class="fa fa-list fa-fw"></i> Menu Management</a></li>
        <li id="userManagement"> <a href="<?php $this->renderUrl("user"); ?>"><i class="fa fa-user fa-fw"></i> User Management</a></li>
        <li id="roleManagement"> <a href="<?php $this->renderUrl("role"); ?>"><i class="fa fa-key fa-fw"></i> Role Management</a></li>
        <?php }; ?>
      </ul>
      <!--./ End Navigator   ---> 
    </div>
    <!-- /.sidebar-collapse --> 
  </div>
  <!-- /.navbar-static-side --> 
</nav>
