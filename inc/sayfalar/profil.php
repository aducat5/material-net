<?php 
if(isset($_GET["ktag"])){
    $proftag = $baglanti->real_escape_string($_GET["ktag"]);
    $idofktag = ktagtoid($baglanti,$proftag);
    $mymats = $baglanti->query("select idpost from posts where iduser = '".$idofktag."' and postPub = 1");
    $mycoms = $baglanti->query("select idcomment from comment where userid = '".$idofktag."'");
    $links = trim(getLinked($idofktag));
    $linksexed = explode(" ",$links);
    $linksayisi = count($linksexed);
    $ppofprof = ppBul($baglanti,$idofktag);
    
    if(isset($_GET["follow"])){
        $kullttag = $kullttag.",".$proftag;
        $fols = $baglanti->query("update userinfo set userFtag = '".$kullttag."' where idUser = '".$kullID."'");
        if($fols){
            header("Location: index.php?sayfa=profil&ktag=".$proftag);
        }   
    }
    if(isset($_GET["unfollow"])){
        $kullttag = str_replace(",".$proftag,"",$kullttag);
        $fols = $baglanti->query("update userinfo set userFtag = '".$kullttag."' where idUser = '".$kullID."'");
        if($fols){
            header("Location: index.php?sayfa=profil&ktag=".$proftag);
        }   
    }
}
if(isset($_POST["baslik"])){
    if(isset($_GET["yenipost"])){
        
        $pbas = $baglanti->real_escape_string($_POST["baslik"]);
        $paci = $baglanti->real_escape_string($_POST["aciklama"]);
        $tags = $_POST["tags"];
        $vtag = $baglanti->real_escape_string(implode(",",$tags));
         
        if(isset($_FILES["dosya"])){        
            //uzantı al
            $fileType = pathinfo(basename($_FILES["dosya"]["name"]), PATHINFO_EXTENSION);
            if($vtag != ""){
                $vtag = $kullTag.",".$fileType.",".$vtag;
            }else{
                $vtag = $kullTag.",".$fileType;
            }
            $ptipi = uzantiDondur($fileType);
            //hedef klasör seç
            if($ptipi == 1){$hedefklasor = "dist/uploads/imgs/";
            }elseif($ptipi == 2){$hedefklasor = "dist/uploads/vids/";
            }elseif($ptipi == 3){$hedefklasor = "dist/uploads/docs/";
            }elseif($ptipi == 4){$hedefklasor = "dist/uploads/waws/";
            }else{
                header("Location: index.php?sayfa=profil&yuzanti&ktag=".$proftag);
            }
            
            if($hedefklasor==""){
                header("Location: index.php?sayfa=profil&yuzanti&ktag=".$proftag);
            }else{
                //hata?
                $hata = $_FILES['dosya']['error'];
                if($hata != 0){echo 'Yüklenirken bir hata gerçekleşmiş.';
                }else{
                    $boyut = $_FILES['dosya']['size'];
                    if($boyut > (1024*1024*20)){echo 'Dosya 20MB den büyük olamaz.';
                    }else{
                        $dosya = $_FILES['dosya']['tmp_name'];
                        $dosyayolu = $hedefklasor.$kullTag.time().".".$fileType;
                        copy($dosya, $dosyayolu);
                        
                        $insq = $baglanti->query("insert into posts(iduser, postTag, postTitle, postDefi, postFile) VALUES ('".$kullID."','".$vtag."','".$pbas."','".$paci."','".$dosyayolu."')");
                        if($insq){
                            header("Location: index.php?sayfa=profil&basar&ktag=".$proftag);
                        }else{echo"Sıkıntı var.";}                    
                    }
                }
            }
            
                         
        }else{echo"Dosya gelmedi";}
    }elseif(isset($_GET["yeniyt"])){
        $pbas = $baglanti->real_escape_string($_POST["baslik"]);
        $paci = $baglanti->real_escape_string($_POST["aciklama"]);
        $yurl = $baglanti->real_escape_string($_POST["yurl"]);
        $tags = $_POST["tags"];
        $vtag = $baglanti->real_escape_string(implode(",",$tags));
        $fileType = "ytb";
        
        if($vtag != ""){
            $vtag = $kullTag.",".$fileType.",".$vtag;
        }else{
            $vtag = $kullTag.",".$fileType;
        }
        
        $rx = '~
      ^(?:https?://)?                           # Optional protocol
       (?:www[.])?                              # Optional sub-domain
       (?:youtube[.]com/watch[?]v=|youtu[.]be/) # Mandatory domain name (w/ query string in .com)
       ([^&]{11})                               # Video id of 11 characters as capture group 1
        ~x';
    
        $has_match = preg_match($rx, $yurl, $matches);
        $yurl = "https://www.youtube.com/embed/".$matches[1];
        
        if($has_match){
            $insq = $baglanti->query("insert into posts(iduser, postTag, postTitle, postDefi, postFile) VALUES ('".$kullID."','".$vtag."','".$pbas."','".$paci."','".$yurl."')");
            if($insq){
                header("Location: index.php?sayfa=profil&basar&ktag=".$proftag);
            }else{echo"Sıkıntı var.";}
        }else{
            header("Location: index.php?sayfa=profil&hatay&ktag=".$proftag);
        }
        
    }
}

if(isset($_POST["unvan"])){
    $yeniad = $baglanti->real_escape_string($_POST["ad"]);
    $yeniun = $baglanti->real_escape_string($_POST["unvan"]);
    $yenitel = $baglanti->real_escape_string($_POST["tel"]);
    $yenidgm = $baglanti->real_escape_string($_POST["dgm"]);
    $eskip = $baglanti->real_escape_string($_POST["eskip"]);
    $tags = $_POST["ftags"];
    $vtag = $baglanti->real_escape_string(implode(",",$tags));
    
    if (empty($_FILES['dosya']['name'])) {
        $upsss = "update userinfo set userName = '".$yeniad."', userTitle = '".$yeniun."', 
            userPhone = '".$yenitel."', 
            userBirth = '".$yenidgm."', 
            userPP = '".$eskip."', 
            userFtag = '".$vtag."'
            where idUser = '".$kullID."'";
        $insq = $baglanti->query($upsss);
            
        if($insq){
            header("Location: index.php?sayfa=profil&ktag=".$proftag."&basarpp");
        }else{
            echo$upsss;}
    }else{
        //uzantı al
        $fileType = pathinfo(basename($_FILES["dosya"]["name"]), PATHINFO_EXTENSION);
        $ptipi = uzantiDondur($fileType);
        //hedef klasör seç
        if($ptipi == 1){$hedefklasor = "dist/img/pps/";}else{
            header("Location: index.php?sayfa=profil&ktag=".$proftag."&yuzanti");
        }
        
        if($hedefklasor==""){
            header("Location: index.php?sayfa=profil&ktag=".$proftag."&yuzanti");
        }else{
            //hata?
            $hata = $_FILES['dosya']['error'];
            if($hata != 0){echo 'Yüklenirken bir hata gerçekleşmiş.';
            }else{
                $boyut = $_FILES['dosya']['size'];
                if($boyut > (1024*1024*20)){echo 'Dosya 20MB den büyük olamaz.';
                }else{
                    $dosya = $_FILES['dosya']['tmp_name'];
                    $dosyayolu = $hedefklasor.$kullTag.time().".".$fileType;
                    copy($dosya, $dosyayolu);
                    
                    $insq = $baglanti->query("update userinfo set 
                    userName = '".$yeniad."', 
                    userTitle = '".$yeniun."', 
                    userPhone = '".$yenitel."', 
                    userBirth = '".$yenidgm."', 
                    userPP = '".$dosyayolu."', 
                    userFtag = '".$vtag."'
                    where idUser = '".$kullID."'");
                    
                    if($insq){
                        header("Location: index.php?sayfa=profil&ktag=".$proftag."&basarpp");
                    }else{echo"Sıkıntı var.";}                    
                }
            }
        }
        
    }         
}

?><div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- row -->
      <div class="row">
        <br class="hidden-lg hidden-md" />
        <br class="hidden-lg hidden-md" />
        <br class="hidden-lg hidden-md" />
        <div class="col-md-12">
            <?php
            if(isset($_GET["hatay"])){
                echo('
                  <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Dikkat!</h4>
                    Girdiğiniz URL bir youtube videosuna ait değildir Gönderiniz kaydedilmedi.
                  </div>
                ');
            }
            
            if(isset($_GET["basar"])){
                echo('
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                    Meteryaliniz başarı ile paylaşıldı.
                  </div>
                ');
            }
            if(isset($_GET["basarpp"])){
                echo('
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Tebrikler!</h4>
                    Profiliniz Başarı ile Güncellendi.
                  </div>
                ');
            }
            if(isset($_GET["yuzanti"])){
                echo('
                  <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-warning"></i> Dikkat!</h4>
                    İzin verilmeyen bir dosya türü yüklemeye çalışıyorsunuz. Gönderiniz kaydedilmedi.
                  </div>
                ');
            }
            
            ?>
        </div>
        <div class="col-md-12">
              <!-- The time line -->

              <ul class="timeline">
                  <!-- timeline item -->
                  <li>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="timeline-item">
                                  <div class="timeline-body">
                                      <div class="box box-widget widget-user">
                                          <!-- Add the bg color to the header using any of the bg-* classes -->
                                          <div class="widget-user-header bg-aqua-active">
                                              <h3 class="widget-user-username"><?php echo(kulladBul($baglanti,$idofktag)); ?></h3>
                                              <h5 class="widget-user-desc"><?php echo(idtounvan($baglanti,$idofktag)); ?></h5>
                                          </div>
                                          <div class="widget-user-image">
                                              <img class="img-circle" src="<?php echo($ppofprof); ?>" alt="Kullanıcı Resmi"/>
                                          </div>
                                          <div class="box-footer">
                                              <div class="row">
                                                  <div class="col-sm-4 border-right">
                                                      <div class="description-block">
                                                          <h5 class="description-header"><?php echo(mysqli_num_rows($mymats)); ?></h5>
                                                          <span class="description-text">Materyal</span>
                                                      </div>
                                                      <!-- /.description-block -->
                                                  </div>
                                                  <!-- /.col -->
                                                  <div class="col-sm-4 border-right">
                                                      <div class="description-block">
                                                          <h5 class="description-header"><?php echo($linksayisi); ?></h5>
                                                          <span class="description-text">Bağlantı</span>
                                                      </div>
                                                      <!-- /.description-block -->
                                                  </div>
                                                  <!-- /.col -->
                                                  <div class="col-sm-4">
                                                      <div class="description-block">
                                                          <h5 class="description-header"><?php echo(mysqli_num_rows($mycoms)); ?></h5>
                                                          <span class="description-text">Yorum</span>
                                                      </div>
                                                      <!-- /.description-block -->
                                                  </div>
                                                  <!-- /.col -->
                                              </div>
                                              
                                              <?php 
                                              if($proftag != $kullTag){
                                                
                                                if(in_array($proftag, $kullFTag)){
                                                    echo('
                                              <div class="row">
                                                  <!-- /.col -->
                                                  <div class="col-sm-offset-4 col-sm-4">
                                                      <div class="description-block">
                                                        <h3><a href="index.php?sayfa=profil&ktag='.$proftag.'&unfollow"><span class="label label-default"><i class="fa fa-remove"></i> Takiptesin </span></a>
                                                      </h3></div>
                                                      <!-- /.description-block -->
                                                  </div>
                                              </div>
                                              ');
                                                }else{
                                                    echo('
                                              <div class="row">
                                                  <!-- /.col -->
                                                  <div class="col-sm-offset-4 col-sm-4">
                                                      <div class="description-block">
                                                        <h3><a href="index.php?sayfa=profil&ktag='.$proftag.'&follow"><span class="label label-success"><i class="fa fa-plus-circle"></i> Takip Et</span></a>
                                                      </h3></div>
                                                      <!-- /.description-block -->
                                                  </div>
                                              </div>
                                              ');
                                                }
                                              }
                                              ?>
                                              <!-- /.row -->
                                              <br /><br />
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <?php 
                          if($proftag == $kullTag){
                          ?>
                          <div class="col-md-8">
                            <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_1" data-toggle="tab">Dosya Yüklemek İçin</a></li>
                              <li><a href="#tab_2" data-toggle="tab">YouTube Vidyosu Eklemek İçin</a></li>
                              <li><a href="#tab_3" data-toggle="tab">Profil Düzenlemek İçin</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="tab_1">
                                <div class="box box-primary">
                                  <div class="box-header with-border text-center">
                                    <h3 class="">Materyal yüklemek istiyorum</h3>
                                  </div>
                                  <!-- /.box-header -->
                                  <!-- form start -->
                                  <form role="form" method="post" enctype="multipart/form-data" action="index.php?sayfa=profil&yenipost=yeni&ktag=<?php echo($proftag); ?>">
                                    <div class="box-body">
                                      <div class="form-group col-md-6">
                                        <label for="baslik">Başlık</label><br  />
                                        <input id="baslik" name="baslik" type="text" class="form-control" placeholder="gönderine bir başlık ver"/><br/>
                                        <label for="aciklama">Açıklama</label><br />
                                        <input id="aciklama" name="aciklama" type="text" class="form-control" placeholder="kısa bir açıklama gir"/>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>Materyal Dosyasını Seç</label>
                                        <input required="" type="file" name="dosya" />
                                        <p class="help-block">sadece aşağıdaki dosya uzantılarını kabul ediyoruz.</p>
                                        <p class="help-block">.pdf, .docx, .pptx, .xslx, .avi, .mp4, .jpg, .png, .mp3</p>
                    
                                         
                                        <div class="form-group">
                                            <label>Etiketler:</label>
                                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="buraya yazın" style="width: 80%;">
                                                <option value=""></option>
                                                <?php 
                                                foreach($kullFTag as $atag){
                                                    echo"<option value='".$atag."'>".$atag."</option>
                                                    ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                      </div>
                                      <div class="form-group col-md-offset-6">
                                          <button type="submit" class="btn btn-success col-md-5">Yükle!</button>
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                  </form>
                                </div>
                              </div>
                              <!-- /.tab-pane -->
                              <div class="tab-pane" id="tab_2">
                                <div class="box box-danger">
                                  <div class="box-header with-border text-center">
                                    <h3 class="">YouTube vidyosu eklemek istiyorum</h3>
                                  </div>
                                  <!-- /.box-header -->
                                  <!-- form start -->
                                  <form role="form" method="post" action="index.php?sayfa=profil&yeniyt&ktag=<?php echo($proftag); ?>">
                                    <div class="box-body">
                                      <div class="form-group col-md-6">
                                        <label for="baslik">Başlık</label><br  />
                                        <input id="baslik" name="baslik" type="text" class="form-control" placeholder="gönderine bir başlık ver"/><br/>
                                        <label for="aciklama">Açıklama</label><br />
                                        <input id="aciklama" name="aciklama" type="text" class="form-control" placeholder="kısa bir açıklama gir"/>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>YouTube Bağlantısı(URL)</label>
                                        <input name="yurl" type="text" class="form-control" placeholder="https://www.youtube.com/watch?..." />
                                        <p class="help-block">sadece youtube vidyolarının linklerini kabul ediyoruz.</p>                     
                                        <div class="form-group">
                                            <label>Etiketler:</label>
                                            <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="buraya yazın" style="width: 100%;">
                                                <?php 
                                                foreach($kullFTag as $atag){
                                                    echo"<option value='".$atag."'>".$atag."</option>
                                                    ";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <p class="help-block">sayfanın üst tarafındaki bağlantıyı kopyalayıp URL bölümüne yapıştırmanız yeterlidir.</p>
                    
                                      </div>
                                      <div class="form-group col-md-offset-6">
                                          <button type="submit" class="btn btn-success col-md-5">Yükle!</button>
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                  </form>
                                </div>
                              </div>
                              <div class="tab-pane" id="tab_3">
                                <div class="box box-warning ">
                                  <div class="box-header with-border text-center">
                                    <h3 class="">Profil Bilgilerimi Düzenlemek İstiyorum</h3>
                                  </div>
                                  <!-- /.box-header -->
                                  <!-- form start -->
                                  <form role="form" method="post" enctype="multipart/form-data" action="index.php?sayfa=profil&infogun&ktag=<?php echo($proftag); ?>">
                                    <div class="box-body">
                                      <div class="form-group col-md-6">
                                        <label for="ad">Ad Soyad</label><br  />
                                        <input id="ad" name="ad" type="text" class="form-control" value="<?php echo($kullAd); ?>" placeholder="Adınız ve Soyadınız"/><br/>
                                        <label for="unvan">Ünvan</label><br />
                                        <select class="form-control" name="unvan">
                                            <?php 
                                            $unvarlar = $baglanti->query("select * from titles");
                                            while($unvanoku = $unvarlar->fetch_assoc()){
                                                echo("
                                                <option "); if($unvanoku["idtitle"] == $kuid){echo"selected ";} echo("value='".$unvanoku["idtitle"]."'>".$unvanoku["titleName"]."</option>");
                                            }
                                            ?>
                                        </select><br />
                                        <label for="tel">Telefon</label><br  />
                                        <input id="tel" name="tel" type="number" class="form-control" value="<?php echo($kullTel); ?>" placeholder="05xx xxx xx xx"/><br/>
                                        <br />
                                        <label for="dgm">Doğum Tarihi</label><br  />
                                        <input id="dgm" name="dgm" type="date" class="form-control" value="<?php echo(dgmtogay($kullDgm)); ?>"/><br/>
                                        
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label>Profil Fotoğrafı Seç</label>
                                        <input type="file" name="dosya" />
                                        <p class="help-block">Yüklemek istemiyorsanız es geçmeniz yeterli.</p>
                                        <p class="help-block">yalnızca .jpg, .png uzantıları kabul edilir</p>
                                        <input type="hidden" name="eskip" value="<?php echo($kullPP); ?>" />
                                        <div class="form-group">
                                            <label>Takip ettiğim etiketler:</label>
                                            <select name="ftags[]" class="form-control select2" multiple="multiple" data-placeholder="buraya yazın" style="width: 80%;">
                                            <?php 
                                            foreach($kullFTag as $atag){
                                                echo"<option selected value='".$atag."'>".$atag."</option>
                                                ";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        
                                      </div>
                                      <div class="form-group col-md-offset-7">
                                          <button type="submit" class="btn btn-success col-md-5">Güncelle!</button>
                                      </div>
                                    </div>
                                    <!-- /.box-body -->
                                  </form>
                                </div>
                              </div>
                              <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                          </div>
                      <!-- nav-tabs-custom -->
                        </div>
                        <?php 
                        }
                        ?>
                    </div>
                </li>
                <li>
                  <div class="timeline-item">
                    <h3 class="box-header no-border">Materyallerim.</h3>
                  </div>
                </li>
                <?php
                getFeed($baglanti,$proftag);
                 ?>
                <li class="time-label">
                  <i class="fa fa-arrow-up bg-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      <span class="bg-white">
                        <a href="#">Yukarı Dön</a>
                      </span>
                </li>

                  <!-- END timeline item -->
                  <!-- timeline item -->
              </ul>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>