<div class="content-wrapper">
    <section class="content">
    <?php 
        if(isset($_GET["postsil"])){
            $sid = $baglanti->real_escape_string($_GET["postsil"]);
            $sils = $baglanti->query("delete from posts where idpost = '".$sid."'");
            if($sils){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Gönderi başarıyla silindi.</p>
                  </div>
                </div>
            </div>
            ');}
        }elseif(isset($_GET["postpub"])){
            $sid = $baglanti->real_escape_string($_GET["postpub"]);
            $sils = $baglanti->query("update posts set postPub = 1 where idpost = '".$sid."'");
            if($sils){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Gönderi başarıyla Yayınlandı.</p>
                  </div>
                </div>
            </div>
            ');}
        }elseif(isset($_GET["postunpub"])){
            $sid = $baglanti->real_escape_string($_GET["postunpub"]);
            $sils = $baglanti->query("update posts set postPub = 0 where idpost = '".$sid."'");
            if($sils){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Gönderi başarıyla Yayından Kaldırıldı.</p>
                  </div>
                </div>
            </div>
            ');}
        }elseif(isset($_GET["postgun"])){
            $pid = $baglanti->real_escape_string($_GET["postgun"]);
            $pgson = $baglanti->query("select * from posts where idpost = '".$pid."'");
            $pgoku = $pgson->fetch_row();
            
            echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Gönderi Bilgilerini Güncelle</h3>
                    </div>
                    <form role="form" method="post" action="index.php?sayfa=adminpost&gunid='.$pid.'">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="postad">Gönderi Başlığı</label>
                          <input type="text" class="form-control" id="postit" name="postit" placeholder="Gönderi Adı" value="'.$pgoku[4].'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Gönderi Açıklaması</label>
                          <textarea class="form-control" id="postac" name="postac" placeholder="Gönderi Açıklama">'.$pgoku[5].'</textarea>
                        </div>
                      </div>
                      <!-- /.box-body -->
        
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Güncelle</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->

                </div>
            </div>
            ');
        }else if(isset($_GET['gunid'])){
            $baslik = $baglanti->real_escape_string($_POST['postit']);
            $aciklama = $baglanti->real_escape_string($_POST['postac']);
            $id = $baglanti->real_escape_string($_GET['gunid']);
            $sorgu = $baglanti->query("UPDATE posts SET postTitle = '".$baslik."', postDefi = '".$aciklama."' WHERE idpost = '".$id."'");            
        }
    ?>
        <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>ID</th>
                              <th>Gönderen</th>
                              <th>Yayın Tarihi</th>
                              <th>Başlık</th>
                              <th>Açıklama</th>
                              <th>Dosya Türü</th>
                              <th>Yayın Durumu</th>
                              <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $uyelerimiss = $baglanti->query("select * from posts");
                            while($uyeoku = $uyelerimiss->fetch_assoc()){
                                $pid = $uyeoku["idpost"];
                                $kid = $uyeoku["iduser"];
                                $pdt = $uyeoku["postDT"];
                                $ptit = $uyeoku["postTitle"];
                                $pdef = $uyeoku["postDefi"];
                                $kpdef = ozet($pdef, 8);
                                $pfile = $uyeoku["postFile"];
                                $pub = $uyeoku["postPub"];
                                
                                $postExt = uzantiBul($pfile);
                                
                                if($postExt == "png" || $postExt == "jpg"){$tur = "Görsel";
                                }elseif($postExt == "avi" || $postExt == "mp4"){$tur = "Video";
                                }elseif($postExt == "pdf" || $postExt == "docx" || $postExt == "xslx" || $postExt == "pptx" || $postExt == "txt"){$tur = "Belge";
                                }elseif($postExt == "mp3" || $postExt == "waw"){$tur = "Ses";}
                                
                                if($pub){
                                    $pub = "Yayında";
                                    $plink = '<a href="index.php?sayfa=adminpost&postunpub='.$pid.'"><span class="label label-warning"><i class="fa fa-warning"></i> Yayını Durdur</span></a>
                                      ';
                                }else{
                                    $pub = "Beklemede";
                                    $plink = '<a href="index.php?sayfa=adminpost&postpub='.$pid.'"><span class="label label-success"><i class="fa fa-check"></i> Yayınla</span></a>
                                      ';
                                }
                                echo('
                                    <tr>
                                      <td>'.htmlspecialchars($pid).'</td>
                                      <td>'.htmlspecialchars($kid).'</td>
                                      <td>'.$pdt.'</td>
                                      <td>'.htmlspecialchars($ptit).'</td>
                                      <td>'.htmlspecialchars($kpdef).'</td>
                                      <td>'.$tur.'</td>
                                      <td>'.$pub.'</td>
                                      <td>
                                        <a href="#" data-toggle="modal" data-target=".modal2'.$pid.'"><span class="label label-danger"><i class="fa fa-remove"></i> Sil</span></a>
                                        <a href="index.php?sayfa=adminpost&postgun='.$pid.'"><span class="label label-primary"><i class="fa fa-arrow-up"></i> Güncelle</span></a>
                                        <a href="'.$pfile.'" download><span class="label label-info"><i class="fa fa-arrow-down"></i> İndir</span></a>
                                        
                                        '.$plink.'</td>
                                    </tr>
                                    <div class="modal modal-danger fade modal2'.$pid.'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Dikkat!!</h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>Seçtiğiniz gönderinin tüm bilgileri veritabanından kalıcı olarak silinecektir. Gönderiyi silmek istediğinizden emin misiniz?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <a class="btn" data-dismiss="modal"><span class="btn btn-primary"> Hayır</span></a>
                                            <a href="index.php?sayfa=adminpost&postsil='.$pid.'"><span class="btn btn-danger"><i class="fa fa-remove"></i> Sil Gitsin</span></a>
                                                    
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                    ');
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>ID</th>
                              <th>Gönderen</th>
                              <th>Yayın Tarihi</th>
                              <th>Başlık</th>
                              <th>Açıklama</th>
                              <th>Dosya Türü</th>
                              <th>Yayın Durumu</th>
                              <th>İşlem</th>  
                            </tr>
                            </tfoot>
                          </table>
                        </div>
            <!-- /.box-body -->
          </div>
              <!-- nav-tabs-custom -->
            </div>
            <!-- /.col -->
          </div>
    </section>
</div>
    
      <!-- /.row -->
      