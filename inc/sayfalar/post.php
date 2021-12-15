<div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="<?php echo $kullicPP; ?>" alt="User Image"/>
                        <span class="username"><a href="#"><?php echo(htmlspecialchars(kulladBul($baglanti,$kullID))); ?></a></span>
                        <span class="description"><?php echo($postDT." Tarihinde paylaşıldı"); ?></span>
                      </div>
                    </div>
            <!-- /.box-header -->
                    <div class="box-body">
                      <h3><?php echo(htmlspecialchars($postTitle)); ?></h3>
                      <?php 
                      $ptipi = uzantiDondur($postExt);
                        echo('<i class="fa fa-'); 
                      if($ptipi == 1){echo("photo text-green");
                      }elseif($ptipi == 2){echo("video-camera text-yellow");
                      }elseif($ptipi == 3){echo("file-text-o text-blue");
                      }elseif($ptipi == 4){echo("file-text-omicrophone text-purple");
                      }elseif($ptipi == 5){echo("youtube-play text-red");}
                    echo(' fa-5x"></i>');
                      ?>
                      <p><?php echo(htmlspecialchars($postDefi)); ?></p>
                      <?php if($postExt!="ytb"){echo'<a href="'.$postFile.'" download class="btn btn-success btn-xs">İndir</a>'; 
                      }else{echo('<iframe width="560" height="315" src="'.$postFile.'" frameborder="0" allowfullscreen></iframe>'); }?>
                    </div>
            <!-- /.box-body -->
                    <div class="box-footer box-comments">
                      <?php 
                      $yorums = $baglanti->query("select * from comment where postID = '".$postidic."' 
                      order by idcomment asc");
                      $yorumsayisi = mysqli_num_rows($yorums);                    
                      if($yorumsayisi>0){
                          while($yorumoku = $yorums->fetch_assoc()){
                            $commerID = $yorumoku["userid"];
                            $comText = $yorumoku["comText"];
                            $comDT = $yorumoku["comDate"];
                            $comSahip = kulladBul($baglanti,$commerID);
                            $kullcomPP = ppBul($baglanti,$commerID);
                            echo('
                            
                              <div class="box-comment">
                                <!-- User image -->
                                <img class="img-circle img-sm" src="'.$kullcomPP.'" alt="User Image">
                
                                <div class="comment-text">
                                      <span class="username">
                                        '.htmlspecialchars($comSahip).'
                                        <span class="text-muted pull-right">8:03 PM Today</span>
                                      </span>'.htmlspecialchars($comText).'
                                </div>
                                <!-- /.comment-text -->
                              </div>
                            ');
                          } 
                      }else{
                        echo"Yorum bulunamadı. İlk yorumu yapabilirsiniz.";
                      }
                      
                      echo('<span class="pull-right text-muted">'.$yorumsayisi.' yorum yapıldı</span>');
                      ?>
                      <!-- /.box-comment -->
                    </div>
            <!-- /.box-footer -->
                    <div class="box-footer">
                      <form action="index.php?sayfa=post&postid=<?php echo($postidic."&pcomid=".$kullID); ?>" method="post">
                        <img class="img-responsive img-circle img-sm" src="<?php echo$kullPP; ?>" alt="kullanıcı profil fotoğrafı"/>
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                          <input name="postext" type="text" class="form-control input-sm" placeholder="yorumu göndermek için enter tuşuna basın"/>
                        </div>
                      </form>
                    </div>
            <!-- /.box-footer -->
                </div>
          
            </div>
          </div>
        </section>
        <!-- /.content -->
  </div>