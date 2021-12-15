<header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>M</b>NET</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Material</b>NET</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <ul class="nav navbar-nav">
        <li class="<?php if($sayfa=="index"){echo"active";} ?>"><a href="index.php">Akış</a></li>    
        <li class="<?php if($sayfa=="kesfet"){echo"active";} ?>"><a href="index.php?sayfa=kesfet">Keşfet</a></li>
        <li class="<?php if($sayfa=="mesajlar"){echo"active";} ?>"><a href="index.php?sayfa=mesajlar">Mesajlar</a></li>
        <li class="<?php if($sayfa=="ayarlar"){echo"active";} ?>"><a href="index.php?sayfa=ayarlar">Ayarlar</a></li>
        <?php 
        if(yetkilimi($baglanti,$kullID)){
            echo('<li><a disabled>|</a></li>');
            echo('<li class="'); if($sayfa=="adminuye"){echo"active";} echo('"><a href="index.php?sayfa=adminuye">Üye Yönetimi</a></li>');
            echo('<li class="'); if($sayfa=="adminpost"){echo"active";} echo('"><a href="index.php?sayfa=adminpost">Gönderi Yönetimi</a></li>');
            echo('<li class="'); if($sayfa=="adminanket"){echo"active";} echo('"><a href="index.php?sayfa=adminanket">Anket Yönetimi</a></li>');
        }
        ?>
      </ul>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo($kullPP); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo($kullAd); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo($kullPP); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo($kullAd); ?>
                  <small><?php echo($kullUnvan); ?></small>
                  <small><?php $sonLogin = SonLogIn($baglanti,$kullID); echo "Son giriş yapışınız : ".$sonLogin;?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="index.php?sayfa=profil&ktag=<?php echo($kullTag); ?>" class="btn btn-default btn-flat">Profil</a>
                </div>
                <div class="pull-right">
                  <a  href="index.php?cikis" class="btn btn-default btn-flat">Çıkış</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo($kullPP); ?>" class="img-circle" alt="Kullanıcı Resmi" />
        </div>
        <div class="pull-left info">
          <p><a href="index.php?sayfa=profil&ktag=<?php echo($kullTag); ?>"><?php echo($kullAd); ?></a></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Aramaya inanmak...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Bağlantılarım</li>
        <?php 
            foreach($mylinks as $bagid){
                echo('<li><a href="index.php?sayfa=mesajlar&id='.$bagid.'"><i class="fa fa-circle-o text-green"></i> <span>'.kulladBul($baglanti,$bagid).'</span></a></li>
                ');
            }
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>