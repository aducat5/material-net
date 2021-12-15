<div class="content-wrapper">
    <section class="content">
    <?php 
        if(isset($_GET["uyesil"])){
            if($kullID != $_GET["uyesil"]){
                $sid = $baglanti->real_escape_string($_GET["uyesil"]);
                $sils = $baglanti->query("delete from user where iduser = '".$sid."'");
                if($sils)
                {
                    echo('
                    <div class="row">
                        <div class="col-md-12">
                          <div class="callout callout-success">
                            <h4>Tebrikler!</h4>
            
                            <p>Üye başarıyla silindi.</p>
                          </div>
                        </div>
                    </div>
                    ');
                }
            }
            else echo('
                    <div class="row">
                        <div class="col-md-12">
                          <div class="callout callout-danger">
                            <h4>YAPMA HOCAM!</h4>
            
                            <p>Tahmin etmiştim. :)) -Ömer</p>
                          </div>
                        </div>
                    </div>
                    ');
        }elseif(isset($_GET["uyegun"])){
            $guid = $_GET["uyegun"];
            $guso = $baglanti->query("SELECT * FROM `user`, userinfo WHERE user.iduser = '".$guid."' and userinfo.idUser = '".$guid."'");
            $guoku = mysqli_fetch_row($guso);
            //değerleri alalım
            $uMail = $guoku[1];
            $uAuth = $guoku[4];
            $uName = $guoku[9];
            $uTit = unvanbul($baglanti,$guoku[10]);
            $uPhon = $guoku[11];
            
            echo('
            <div class="row">
                <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Üye Bilgilerini Güncelle</h3>
                    </div>
                    <form role="form" action="index.php?sayfa=adminuye&uyeid='.$guid.'" method="post">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="postad">Üye Ad Soyad</label>
                          <input type="text" class="form-control" id="postit" name="kullad" placeholder="Kullanıcı Adı" value="'.$uName.'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Üye Ünvan</label>
                          <select class="form-control" name="kullunvan">');
                            
                            $unvarlar = $baglanti->query("select * from titles");
                            while($unvanoku = $unvarlar->fetch_assoc()){
                                echo("
                                <option value='".$unvanoku["idtitle"]."' "); if($uTit == $unvanoku["idtitle"]){echo"selected ";} echo(">".$unvanoku["titleName"]."</option>");
                            }
                          echo('</select>
                        </div>
                        <div class="form-group">
                          <label for="pos">Üye e-Posta Adresi</label>
                          <input type="text" class="form-control" id="pos" name="kullmail" placeholder="Kullanıcı e-Posta" value="'.$uMail.'"/>
                        </div>
                        <div class="form-group">
                          <label for="pos">Üyeye Yeni Şifre Tanımla</label>
                          <input type="text" class="form-control" id="pos" name="kullsif" placeholder="Kullanıcı şifre" />
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
            
        }
        
        if(isset($_POST['kullad'])){
            if(isset($_GET['uyeid'])){
                $uyeid = $baglanti->real_escape_string($_GET['uyeid']);
                $uyead = $baglanti->real_escape_string($_POST['kullad']);
                $uyeunvan = $baglanti->real_escape_string($_POST['kullunvan']);
                $uyemail = $baglanti->real_escape_string($_POST['kullmail']);
                if(isset($_POST['kullsif'])){
                    $uyesifre = $baglanti->real_escape_string($_POST['kullsif']);
                    $shalaSifre = sha1($uyesifre);
                    $shaIlk = substr($shalaSifre,0,-20);
                    $shaSon = substr($shalaSifre,20);
                    $sorguGuncelle = $baglanti->query("UPDATE user SET userMail = '".$uyemail."', userPass1 = '".$shaIlk."', userPass2 = '".$shaSon."' WHERE iduser = '".$uyeid."'");
                    $sorguGuncelle2 = $baglanti->query("UPDATE userinfo SET userName = '".$uyead."', userTitle = '".$uyeunvan."' WHERE idUser = '".$uyeid."'");   
                    if($sorguGuncelle and $sorguGuncelle2){
                        echo('
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="callout callout-success">
                                    <h4>Tebrikler!</h4>
                    
                                    <p>Üye başarıyla güncellendi.</p>
                                  </div>
                                </div>
                            </div>
                            ');
                    }
                    else echo"olmadı";
                }
                else{
                    $sorguGuncelle = $baglanti->query("UPDATE user SET userMail = '".$uyemail."' WHERE iduser = '".$uyeid."'");
                    $sorguGuncelle2 = $baglanti->query("UPDATE userinfo SET userName = '".$uyead."', userTitle = '".$uyeunvan."' WHERE idUser = '".$uyeid."'");
                    if($sorguGuncelle and $sorguGuncelle2){
                        echo('
                            <div class="row">
                                <div class="col-md-12">
                                  <div class="callout callout-success">
                                    <h4>Tebrikler!</h4>
                    
                                    <p>Üye başarıyla güncellendi.</p>
                                  </div>
                                </div>
                            </div>
                            ');
                    }
                    else echo"olmadı";
                }
                
            }
            else{
                header("Location:index.php?sayfa=adminuye");
            }
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
                              <th>e-Posta</th>
                              <th>Ad Soyad</th>
                              <th>Ünvan</th>
                              <th>Telefon</th>
                              <th>Doğum Tarihi</th>
                              <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $uyelerimiss = $baglanti->query("select * from user where iduser != '".$kullID."'");
                            while($uyeoku = $uyelerimiss->fetch_assoc()){
                                $kid = $uyeoku["iduser"];
                                $kail = $uyeoku["userMail"];
                                
                                $uyebilgileri = $baglanti->query("select * from userinfo where idUser = '".$kid."'");
                                while($ubku = $uyebilgileri->fetch_assoc()){
                                    $kad = $ubku["userName"];
                                    $kodi = $ubku["userTitle"];
                                    $ktel = $ubku["userPhone"];
                                    $kittle = unvanbul($baglanti,$kodi);
                                    $kdogma = tarihduzelt($ubku["userBirth"]);
                                    
                                    echo('
                                    <tr>
                                      <td>'.$kid.'</td>
                                      <td>'.$kail.'</td>
                                      <td>'.$kad.'</td>
                                      <td>'.$kittle.'</td>
                                      <td>'.$ktel.'</td>
                                      <td>'.$kdogma.'</td>
                                      <td>
                                        <a href="#" data-toggle="modal" data-target=".modal2'.$kid.'"><span class="label label-danger"><i class="fa fa-remove"></i> Sil</span></a>
                                        <a href="index.php?sayfa=adminuye&uyegun='.$kid.'"><span class="label label-success"><i class="fa fa-arrow-up"></i> Güncelle</span></a>
                                       
                                      </td>
                                    </tr>
                                    <div class="modal modal-danger fade modal2'.$kid.'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Dikkat!!</h4>
                                          </div>
                                          <div class="modal-body">
                                            <p>Seçtiğiniz üyenin tüm bilgileri veritabanından kalıcı olarak silinecektir. Üyeyi silmek istediğinizden emin misiniz?</p>
                                          </div>
                                          <div class="modal-footer">
                                            <a class="btn" data-dismiss="modal"><span class="btn btn-primary"> Hayır</span></a>
                                            <a href="index.php?sayfa=adminuye&uyesil='.$kid.'"><span class="btn btn-danger"><i class="fa fa-remove"></i> Sil Gitsin</span></a>
                                                    
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                    </div>
                                    ');
                                }
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th>ID</th>
                              <th>e-Posta</th>
                              <th>Ad Soyad</th>
                              <th>Ünvan</th>
                              <th>Telefon</th>
                              <th>Doğum Tarihi</th>
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
      