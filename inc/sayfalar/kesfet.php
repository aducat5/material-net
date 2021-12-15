<?php 
$gorsels = $baglanti->query("select idpost from posts where postTag LIKE '%,jpg%' or postTag LIKE '%,png%'");
$videos = $baglanti->query("select idpost from posts where postTag LIKE '%,avi%' or postTag LIKE '%,mp4%' or postTag LIKE '%,ytb%'");
$ofiss = $baglanti->query("select idpost from posts where postTag LIKE '%,xlsx%' or postTag LIKE '%,docx%' or postTag LIKE '%,pptx%' or postTag LIKE '%,pdf%' or postTag LIKE '%,txt%'");
$sess = $baglanti->query("select idpost from posts where postTag LIKE '%,mp3%' or postTag LIKE '%,waw%'");
?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">

              <p><?php echo(mysqli_num_rows($gorsels)); ?> materyal</p>
              <h3>Görseller</h3>
            </div>
            <div class="icon">
              <i class="fa fa-image"></i>
            </div>
            <a href="index.php?sayfa=kesfet&ptip=jpg,png" class="small-box-footer">
              <h4>Kategori Seç! <i class="fa fa-arrow-circle-right"></i></h4>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">

              <p><?php echo(mysqli_num_rows($videos)); ?> materyal</p>
              <h3>Videolar</h3>
            </div>
            <div class="icon">
              <i class="fa fa-video-camera"></i>
            </div>
            <a href="index.php?sayfa=kesfet&ptip=mp4,avi,ytb" class="small-box-footer">
              <h4>Kategori Seç! <i class="fa fa-arrow-circle-right"></i></h4>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">

              <p><?php echo(mysqli_num_rows($ofiss)); ?> materyal</p>
              <h3>Ofis/Belge</h3>
            </div>
            <div class="icon">
              <i class="fa fa-file-text-o"></i>
            </div>
            <a href="index.php?sayfa=kesfet&ptip=pdf,docx,xlsx,pptx,txt" class="small-box-footer">
              <h4>Kategori Seç! <i class="fa fa-arrow-circle-right"></i></h4>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">

              <p><?php echo(mysqli_num_rows($sess)); ?> materyal</p>
              <h3>Sesler</h3>
            </div>
            <div class="icon">
              <i class="fa fa-microphone"></i>
            </div>
            <a href="index.php?sayfa=kesfet&ptip=mp3,waw" class="small-box-footer">
              <h4>Kategori Seç! <i class="fa fa-arrow-circle-right"></i></h4>
            </a>
          </div>
        </div>
        <!-- ./col -->

      </div>
      <div class="row">
        <div class="col-md-4">
            <div class="callout callout-warning">
                <h4>#etiketle!</h4>

                <p>gönderileri aramak için etiketleri kullanabilirsin.</p>
                <br />
                <form method="post" action="index.php?sayfa=kesfet">
                    <div class="form-group">
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="buraya yazın" style="width: 100%;">
                            <?php 
                            foreach($kullFTag as $atag){
                                echo"<option value='".$atag."'>".$atag."</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">filtrele <i class="fa fa-arrow-right"></i></button>
                </form>
                
            </div>
        </div>
        <div class="col-md-8">
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-red">
                    Materyal Akışı
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            
            <?php 
            if(isset($_GET["ptip"])){
                $vtag = $baglanti->real_escape_string($_GET["ptip"]);
                getFeed($baglanti, $vtag);
            }elseif(isset($_POST["tags"])){
                $tags = $_POST["tags"];
                $vtag = $baglanti->real_escape_string(implode(",",$tags));
                getFeed($baglanti, $vtag);
            }
            ?>
            
            <li class="time-label">
              <i class="fa fa-arrow-up bg-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="bg-white">
                    <a href="#">Yukarı Dön</a>
                  </span>
            </li>
          </ul>
        </div>
            <!-- /.col -->
       </div>
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>