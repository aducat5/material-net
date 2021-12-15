<div class="content-wrapper">
    <section class="content">
    <?php 
        if(isset($_GET["anketsil"])){
            $sid = $baglanti->real_escape_string($_GET["anketsil"]);
            $sils = $baglanti->query("delete from survey where idsurvey = '".$sid."'");
            if($sils){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Anket başarıyla silindi.</p>
                  </div>
                </div>
            </div>
            ');}
        }elseif(isset($_GET["surveygun"])){
            $pid = $baglanti->real_escape_string($_GET["surveygun"]);
            $pgson = $baglanti->query("select * from survey where idsurvey = '".$pid."'");
            $pgoku = $pgson->fetch_row();
            $cvpoku = $baglanti->query("select * from surveyanswer where surveyID = '".$pid."'");
            while($okuuuu = $cvpoku->fetch_assoc()){
                $surveyans[] = $okuuuu['surveyAnsText'];}
            echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Anket Bilgilerini Güncelle</h3>
                    </div>
                    <form role="form" method="post" action="index.php?sayfa=adminanket&guncelleid='.$pid.'">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="postad">Anket Sorusu</label>
                          <input type="text" class="form-control" id="postit" name="survAd" placeholder="Gönderi Adı" value="'.$pgoku[1].'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 1</label>
                          <input type="text" class="form-control" id="postac" name="survC1" placeholder="Cevap" value="'.$surveyans[0].'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 2</label>
                          <input type="text" class="form-control" id="postac" name="survC2" placeholder="Cevap2" value="'.$surveyans[1].'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 3</label>
                          <input type="text" class="form-control" id="postac" name="survC3" placeholder="Cevap3" value="'.$surveyans[2].'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 4</label>
                          <input type="text" class="form-control" id="postac" name="survC4" placeholder="Cevap4" value="'.$surveyans[3].'">
                        </div>
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
                <br /><br />
            
            ');
        }elseif(isset($_GET["yenianket"])){
            $anketsoru = $baglanti->real_escape_string($_POST["ankets"]);
            $anketle = $baglanti->query("insert into survey(surveyText) values('".$anketsoru."')");
            if($anketle){
                $idbul = $baglanti->query("select idsurvey from survey order by idsurvey desc limit 1");
                $idoku = mysqli_fetch_row($idbul);
                $pid = $idoku[0];
            echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Anket Sorularını Gir</h3>
                    </div>
                    <form role="form" method="post" action="index.php?sayfa=adminanket&ankid='.$pid.'">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="postad">Anket Sorusu</label>
                          <input type="text" class="form-control" id="postit" name="survAd" placeholder="Gönderi Adı" disabled value="'.$anketsoru.'">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 1</label>
                          <input type="text" class="form-control" id="postac" name="survC1" placeholder="Cevap">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 2</label>
                          <input type="text" class="form-control" id="postac" name="survC2" placeholder="Cevap2">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 3</label>
                          <input type="text" class="form-control" id="postac" name="survC3" placeholder="Cevap3">
                        </div>
                        <div class="form-group">
                          <label for="postac">Cevap 4</label>
                          <input type="text" class="form-control" id="postac" name="survC4" placeholder="Cevap4">
                        </div>
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
                <br /><br />
            
            ');   
            }
        }elseif(isset($_GET['guncelleid'])){
            $sid = $baglanti->real_escape_string($_GET['guncelleid']);{
                $i = 0;
                $c[0] = $baglanti->real_escape_string($_POST['survC1']);
                $c[1] = $baglanti->real_escape_string($_POST['survC2']);
                $c[2] = $baglanti->real_escape_string($_POST['survC3']);
                $c[3]= $baglanti->real_escape_string($_POST['survC4']);
                $ad = $baglanti->real_escape_string($_POST['survAd']);
                
                $soruGuncelle = $baglanti->query("UPDATE survey SET surveyText = '".$ad."' WHERE idsurvey = '".$sid."'");
                $cevapID = $baglanti->query("SELECT * FROM surveyAnswer where surveyID = '".$sid."'");
                while($oku = $cevapID->fetch_assoc()){
                $cevapGuncelle = $baglanti->query("UPDATE surveyAnswer SET surveyAnsText = '".$c[$i]."' WHERE idsurveyAnswer = '".$oku['idsurveyAnswer']."'");
                $i++;
                }
                if($cevapGuncelle){
                    echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Anket başarıyla güncellendi.</p>
                  </div>
                </div>
            </div>
            ');
                }
            }
        }elseif(isset($_GET["postpub"])){
            $sid = $baglanti->real_escape_string($_GET["postpub"]);
            $sils1 = $baglanti->query("update survey set surveyPub = 0 where idsurvey != '".$sid."'");
            $sils2 = $baglanti->query("update survey set surveyPub = 1 where idsurvey = '".$sid."'");
            $sils3 = $baglanti->query("update userinfo set userAnsd = 0 where 1 = 1");
            if($sils1 and $sils2 and $sils3){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Anket başarıyla Yayınlandı.</p>
                  </div>
                </div>
            </div>
            ');}
        }elseif(isset($_GET["postunpub"])){
            $sid = $baglanti->real_escape_string($_GET["postunpub"]);
            $sils = $baglanti->query("update survey set surveyPub = 0 where idsurvey = '".$sid."'");
            if($sils){echo('
            <div class="row">
                <div class="col-md-12">
                  <div class="callout callout-success">
                    <h4>Tebrikler!</h4>
    
                    <p>Anket başarıyla Yayından Kaldırıldı.</p>
                  </div>
                </div>
            </div>
            ');}
        }
        
        if(isset($_GET["ankid"])){
            $anketid = $baglanti->real_escape_string($_GET["ankid"]);
            $c1 = $baglanti->real_escape_string($_POST["survC1"]);
            $c2 = $baglanti->real_escape_string($_POST["survC2"]);
            $c3 = $baglanti->real_escape_string($_POST["survC3"]);
            $c4 = $baglanti->real_escape_string($_POST["survC4"]);
            
            $anketsorula = $baglanti->query("insert into surveyanswer(surveyID, surveyAnsText) 
            values('".$anketid."','".$c1."')
            ,values('".$anketid."','".$c2."')
            ,values('".$anketid."','".$c3."')
            ,values('".$anketid."','".$c4."')
            ");
        }
        
    ?>
        <div class="row">
        <?php 
        if(!isset($_GET["yenianket"])){
            
        
        ?>
            <div class="col-md-6">
                <form action="index.php?sayfa=adminanket&yenianket" method="post">
                    <input type="text" name="ankets" class="form-control" placeholder="Anket Sorusu"/>
            </div>
            <div class="col-md-2">
            
                    <input type="submit" class="btn btn-flat btn-success" value="Yeni Anket" />
                </form>
            </div><hr />
            
        <?php } ?>
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="box">
                        <!-- /.box-header -->
                        <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>ID</th>
                              <th>Anket Sorusu</th>
                              <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $surveylerimiss = $baglanti->query("select * from survey");
                            while($surveyoku = $surveylerimiss->fetch_assoc()){
                                $kid = $surveyoku["idsurvey"];
                                
                                $surveybilgileri = $baglanti->query("select * from survey where idsurvey = '".$kid."'");
                                while($ubku = $surveybilgileri->fetch_assoc()){
                                    $kad = $ubku["surveyText"];
                                    $pub = $ubku["surveyPub"];
                                    if($pub){
                                    $pub = "Yayında";
                                    $plink = '<a href="index.php?sayfa=adminanket&postunpub='.$kid.'"><span class="label label-warning"><i class="fa fa-warning"></i> Yayını Durdur</span></a>
                                      ';
                                        }else{
                                    $pub = "Beklemede";
                                        $plink = '<a href="index.php?sayfa=adminanket&postpub='.$kid.'"><span class="label label-success"><i class="fa fa-check"></i> Yayınla</span></a>
                                      ';
                                    }
                                    
                                    echo('
                                    <tr>
                                      <td>'.$kid.'</td>
                                      <td>'.$kad.'</td>
                                      
                                      <td>
                                        <a href="#" data-toggle="modal" data-target=".modal2'.$kid.'"><span class="label label-danger"><i class="fa fa-remove"></i> Sil</span></a>
                                        <a href="index.php?sayfa=adminanket&surveygun='.$kid.'"><span class="label label-success"><i class="fa fa-arrow-up"></i> Güncelle</span></a>
                                        '.$plink.'
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
                                            <a href="index.php?sayfa=adminanket&anketsil='.$kid.'"><span class="btn btn-danger"><i class="fa fa-remove"></i> Sil Gitsin</span></a>
                                                    
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
                              <th>Anket Sorusu</th>
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
      