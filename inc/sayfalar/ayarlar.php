<?php 

$ayarlars = $baglanti->query("select * from usersettings where iduser='".$kullID."'");
$ayaroku = mysqli_fetch_row($ayarlars);
$infos = $ayaroku[2];
$pps = $ayaroku[3];
$messages = $ayaroku[4];

if(isset($_POST["mesajset"])){
    $yenim = $baglanti->real_escape_string($_POST["mesajset"]);
    $mups = $baglanti->query("update usersettings set messageMe = '".$yenim."' where iduser = '".$kullID."'");
}
if(isset($_POST["ppset"])){
    $yenip = $baglanti->real_escape_string($_POST["ppset"]);
    $yenii = $baglanti->real_escape_string($_POST["infset"]);
    $mups = $baglanti->query("update usersettings set infoShare = '".$yenii."', ppShare = '".$yenip."' where iduser = '".$kullID."'");
}

if(isset($_POST["yenim"])){
    $yenim = $baglanti->real_escape_string($_POST["yenim"]);
    $mups = $baglanti->query("update user set userMail = '".$yenim."' where iduser = '".$kullID."'");
}

if(isset($_POST["eskis"])){
    $eskip = $baglanti->real_escape_string($_POST["eskis"]);
    $yenip1 = $baglanti->real_escape_string($_POST["siff1"]);
    $yenip2 = $baglanti->real_escape_string($_POST["siff2"]);
    
    $shaEncode = sha1($eskip);
    $shaIlk = substr($shaEncode,0,-20);
    $shaSon = substr($shaEncode,20);

    $loginQuery = "select iduser from user where userPass1='".$shaIlk."' and userPass2='".$shaSon."'";
    $loginResult = $baglanti->query($loginQuery);
    $loginOK = mysqli_num_rows($loginResult);
    if($loginOK>0){
        if($yenip1 == $yenip2){
            $shayeni = sha1($yenip1);
            $shailky = substr($shayeni,0,-20);
            $shasony = substr($shayeni,20);
            
            $upth = $baglanti->query("update user set userPass1 = '".$shailky."', userPass2 = '".$shasony."' where iduser = '".$kullID."'");    
        }else{
            echo"burası";
        }
        
    }else{
        echo"olmuyo olmuuyor";
        echo($loginQuery);
    }
}
?>
<div class="content-wrapper">
    <section class="content">
        <?php 
        if(isset($_POST["yenim"])){
        if($mups){
            echo('
        <div class="row">
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
            Ayarlarınız Başarı ile Güncellendi.
          </div>
        </div>');
        }
        }
        if(isset($_POST["eskis"])){
        if($upth){
            echo('
            <div class="row">
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                Ayarlarınız Başarı ile Güncellendi.
              </div>
            </div>');
        }
        }
        if(isset($_POST["mesajset"])){
        if($mups){
            echo('
            <div class="row">
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                Ayarlarınız Başarı ile Güncellendi.
              </div>
            </div>');
        }
        }
        if(isset($_POST["infset"])){
        if($mups){
            echo('
            <div class="row">
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                Ayarlarınız Başarı ile Güncellendi.
              </div>
            </div>');
        }
        }
        ?>
        <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#hesap" data-toggle="tab">Hesap Ayarları</a></li>
                  <li><a href="#mesaj" data-toggle="tab">Mesajlaşma</a></li>
                  <li><a href="#gizli" data-toggle="tab">Gizlilik</a></li>
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      Yardım <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="#sss" data-toggle="tab">Sık Sorulan sorular</a></li>-->
                      <!--<li role="presentation"><a role="menuitem" tabindex="-1" href="#yardim" data-toggle="tab">Yardım İsteği Oluştur</a></li>-->
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#mnet" data-toggle="tab">MaterialNET Hakkında</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#ilet" data-toggle="tab">İletişim</a></li>
                    </ul>
                  </li>
                  <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="hesap">
                    <div class="row">
                        <form method="post" action="index.php?sayfa=ayarlar">
                            <div class="col-md-6">
                                <input type="mail" value="<?php echo($kmail); ?>" class="form-control" required="" name="yenim" placeholder="Yeni E-Mailiniz" />
                            </div>
                            <div class="col-md-6">
                                <input type="submit" required="" class="btn btn-flat btn-success col-md-12" value="E-Maili Yenile" />
                            </div>
                        </form>
                    </div>
                    <br />
                    <div class="row">
                        <form method="post" action="index.php?sayfa=ayarlar">
                            <div class="col-md-12">
                                <input type="password" class="form-control" required="" name="eskis" placeholder="Eski Şifreniz" />
                            </div>
                    </div>
                    <br />
                    <div class="row">
                            <div class="col-md-6">
                                <input type="password" class="form-control" required="" name="siff1" placeholder="Yeni Şifreniz" />
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="form-control" required="" name="siff2" placeholder="Yeni Şifrenizin Tekrarı" />
                            </div>
                    </div>
                    <br />
                    <div class="row">
                            <div class="col-md-12">
                                <input type="submit" required="" class="btn btn-flat btn-success col-md-12" value="Şifreyi Değiştir" />
                            </div>
                        </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="mesaj">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Bana Kimler Mesaj Atabilsin?</label><br />
                            <form action="index.php?sayfa=ayarlar" method="post">
                                <select class="form-control" name="mesajset">
                                    <option <?php if($messages == 0){echo("selected");} ?> value="0">Herkes</option>
                                    <option <?php if($messages == 1){echo("selected");} ?> value="1">Sadece Bağlantılarım</option>
                                    <option <?php if($messages == -1){echo("selected");} ?> value="-1">Hiçkimse</option>
                                </select><br />
                            <input type="submit" class="btn btn-flat btn-success" value="Seç" />
                            </form>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="gizli">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="index.php?sayfa=ayarlar" method="post">
                            <label>Bilgilerimi Kimler Görebilsin?</label><br />
                                <select class="form-control" name="infset">
                                    <option <?php if($infos == 0){echo("selected");} ?> value="0">Herkes</option>
                                    <option <?php if($infos == 1){echo("selected");} ?> value="1">Sadece Bağlantılarım</option>
                                    <option <?php if($infos == -1){echo("selected");} ?> value="-1">Hiçkimse</option>
                                </select><br />
                            <label>Profil Fotoğrafımı Kimler Görebilsin?</label><br />
                                <select class="form-control" name="ppset">
                                    <option <?php if($pps == 0){echo("selected");} ?> value="0">Herkes</option>
                                    <option <?php if($pps == 1){echo("selected");} ?> value="1">Sadece Bağlantılarım</option>
                                    <option <?php if($pps == -1){echo("selected");} ?> value="-1">Hiçkimse</option>
                                </select><br />
                            <input type="submit" class="btn btn-flat btn-success" value="Seç" />
                            </form>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane 
                  <div class="tab-pane" id="sss">
                    <div class="row">
                        <div class="col-md-12">
                          <div class="box box-solid">
                            <div class="box-header with-border">
                              <h3 class="box-title">Collapsible Accordion</h3>
                            </div>
                            <!-- /.box-header 
                            <div class="box-body">
                              <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it 
                                <div class="panel box box-primary">
                                  <div class="box-header with-border">
                                    <h4 class="box-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        Collapsible Group Item #1
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="box-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                      labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                                <div class="panel box box-danger">
                                  <div class="box-header with-border">
                                    <h4 class="box-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        Collapsible Group Danger
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="box-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                      labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                                <div class="panel box box-success">
                                  <div class="box-header with-border">
                                    <h4 class="box-title">
                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        Collapsible Group Success
                                      </a>
                                    </h4>
                                  </div>
                                  <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="box-body">
                                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                                      wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                                      eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                                      assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                                      nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                                      farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                                      labore sustainable VHS.
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- /.box-body 
                          </div>
                          <!-- /.box 
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane 
                  <div class="tab-pane" id="yardim">
                    <!--<div class="row">
                        <div class="col-md-7">
                          <div class="box box-info">
                                <div class="box-header">
                                  <i class="fa fa-envelope"></i>
                    
                                  <h3 class="box-title">Yardım İsteği Oluştur</h3>
                                  <!-- /. tools 
                                </div>
                                <!--<div class="box-body">
                                  <form action="#" method="post">
                                    <div class="form-group">
                                      <input type="text" class="form-control" name="subject" placeholder="Konu"/>
                                    </div>
                                    <div>
                                      <textarea class="textarea" placeholder="Mesaj" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                    </div>
                                  </form>
                                </div>
                                <div class="box-footer clearfix">
                                  <button type="button" class="pull-right btn btn-default" id="sendEmail">Gönder
                                    <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-5">
                        <div class="box box-info">
                            <div class="box-header with-border">
                              <h3 class="box-title">Son İstekler</h3>
                            </div>
                            <!-- /.box-header 
                            <div class="box-body">
                              <!--<div class="table-responsive">
                                <table class="table no-margin">
                                  <thead>
                                  <tr>
                                    <th>İstek no</th>
                                    <th>Başlık</th>
                                    <th>Durum</th>
                                    <th>İşlem</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    
                                    <td>
                                        <a href="#">Sil</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-info">Processing</span></td>
                                    
                                    <td>
                                        <a href="#">Sil</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="label label-warning">Pending</span></td>
                                    
                                    <td>
                                        <a href="#">Sil</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="label label-danger">Delivered</span></td>
                                    
                                    <td>
                                        <a href="#">Sil</a>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="label label-success">Shipped</span></td>
                                    <td>
                                        <a href="#">Sil</a>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.table-responsive 
                            </div>
                            <!-- /.box-footer 
                          </div>
                        </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="mnet">
                    MNET - MaterialNet, Marmara Üniversitesi kapsamında geliştirilen, eğitim görevlilerinin ve öğrencilerin dosya paylaşımı yapmasını sağlayacak sosyal bir platform projesidir.
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="ilet">
                    <div class="box box-info">
                        <div class="box-header">
                          <i class="fa fa-envelope"></i>
            
                          <h3 class="box-title">Bizimle İletişime Geçin</h3>
                          <!-- /. tools -->
                        </div>
                        <div class="box-body">
                          <form action="#" method="post">
                            <div class="form-group">
                              <input type="email" class="form-control" name="emailto" disabled="true" value="info@slothdevelopment.com"/>
                            </div>
                            <div class="form-group">
                              <input type="text" class="form-control" name="subject" placeholder="Konu">
                            </div>
                            <div>
                              <textarea class="textarea" placeholder="Mesaj" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                          </form>
                        </div>
                        <div class="box-footer clearfix">
                          <button type="button" class="pull-right btn btn-default" id="sendEmail">Gönder
                            <i class="fa fa-arrow-circle-right"></i></button>
                        </div>
                      </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
    </section>
</div>
    
      <!-- /.row -->
      