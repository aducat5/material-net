<?php 
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
                header("Location: index.php?sayfa=index&yuzanti");
            }
            
            if($hedefklasor==""){
                header("Location: index.php?sayfa=index&yuzanti");
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
                            header("Location: index.php?sayfa=index&basar");
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
                header("Location: index.php?sayfa=index&basar");
            }else{echo"Sıkıntı var.";}
        }else{
            header("Location: index.php?sayfa=index&hatay");
        }
        
    }
}
?>
<div class="content-wrapper">
        <!-- Main content -->
    <section class="content">
      <div class="row">
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
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab">Dosya Yüklemek İçin</a></li>
          <li><a href="#tab_2" data-toggle="tab">YouTube Vidyosu Eklemek İçin</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
                <div class="box box-primary">
              <div class="box-header with-border text-center">
                <h3 class="">Materyal yüklemek istiyorum</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data" action="index.php?sayfa=index&yenipost=yeni">
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
              <form role="form" method="post" action="index.php?sayfa=index&yeniyt">
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
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
        </div>
      </div>
      <!-- row -->
      <div class="row">
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
            getFeed($baglanti, $kullttag);
            ?>
            
            <li class="time-label">
              <i class="fa fa-arrow-up bg-blue"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <span class="bg-white">
                    <a href="#">Yukarı Dön</a>
                  </span>
            </li>
          </ul>
        </div>
        <div class="col-md-4">
            <?php 
                $sursor = $baglanti->query("select * from survey where surveyPub = '1'");
                while($suroku = $sursor->fetch_assoc()){
                    $surText = $suroku["surveyText"];
                    $surID = $suroku["idsurvey"];
                    echo('
                    <ul class="timeline">
                        <!-- timeline item -->
                        <li>
                        <div class="info-box">
                          <!-- Apply any bg-* class to to the icon to color it -->
                          <span class="info-box-icon bg-yellow"><i class="fa fa-question-circle fa-2x"></i></span>
                          <div class="info-box-content">
                            <span class="info-box-text">Ayın Sorusu</span>
                            <span class="info-box-number">'.htmlspecialchars($surText).'</span>
                          </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                        </li>
                        ');
                        //mysqli fetch row örneği
                        $simdicevaplar = $baglanti->query("select * from surveyanswer where surveyID = '".$surID."'");
                        $kackez = $baglanti->query("select sum(surveyAnsed) from surveyanswer where surveyID = '".$surID."'");
                        $kacoku = mysqli_fetch_row($kackez);
                        $toplamoy = $kacoku[0];
                        while($coku = $simdicevaplar->fetch_assoc()){
                            if($kullAnsd == 1){
                                $ansText = $coku["surveyAnsText"];
                                $ansEd = $coku["surveyAnsed"];
                                echo('
                                    
                            <li class="time-label">
                                  
                                '); 
                                if($ansEd > 0){
                                    echo('
                                  <span class="bg-aqua">
                                    <small>'.htmlspecialchars($ansText).'</small>
                                  </span>
                                  <div class="progress">
                                      <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="'.$ansEd.'"
                                      aria-valuemin="0" aria-valuemax="'.$toplamoy.'" style="width:'.$ansEd * 100 / $toplamoy .'%">
                                        <big>'.$ansEd.' oy</big>
                                      </div>
                                  </div>
                                  ');
                                }else{
                                    echo('
                                  <span class="bg-gray">
                                    <small>'.htmlspecialchars($ansText).'</small>
                                  </span>
                                  <div class="progress">
                                      <div class="progress-bar progress-bar bg-gray progress-bar-striped" role="progressbar" aria-valuenow="'.$ansEd.'"
                                      aria-valuemin="0" aria-valuemax="'.$toplamoy.'" style="width: 100%">
                                        henüz seçilmedi
                                      </div>
                                  </div>
                                  ');
                                }
                                echo('                                       
                            </li>
                            '); 
                            }else{
                                $ansText = $coku["surveyAnsText"];
                                $sAID = $coku["idsurveyAnswer"];
                                echo('
                            <li>
                              <i class="fa fa-thumbs-o-up bg-blue"></i>
            
                              <div class="timeline-item">
                                <h3 class="timeline-header">'.htmlspecialchars($ansText).'</h3><a href="index.php?sayfa=index&oyla='.$sAID.'" class="btn btn-sm btn-success pull-right"><i class="fa fa-check"></i></a>
                              </div>
                            </li>
                            ');   
                            }
                        }
                        if(isset($_GET["oyla"])){
                            $oylanacak = $_GET["oyla"];
                            oyla($baglanti,$kullID, $surID, $oylanacak);
                        }
                        echo('
                        <li class="time-label">
                              <span class="bg-orange">
                                Toplam '.$toplamoy.' defa oylanmış
                              </span>
                        </li>
                    </ul>
                    ');
                }
                
            ?>
            
        </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

      <!-- /.row -->
    </section>
        <!-- /.content -->
  </div>