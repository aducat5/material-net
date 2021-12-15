<?php 
if(isset($_GET["id"])){
    $conid = $baglanti->real_escape_string($_GET["id"]);
    $findcon = $baglanti->query("select * from messages where (touser = '".$conid."' and fromuser = '".$kullID."') or (touser = '".$kullID."' and fromuser = '".$conid."') order by date");
}else{
    $conid = "";
}

if(isset($_POST["mtext"])){
    $mesaj = $baglanti->real_escape_string($_POST["mtext"]);
    $touser = $baglanti->real_escape_string($_GET["id"]);
    $mesajat = $baglanti->query("insert into messages(fromuser,touser,message) values('".$kullID."','".$touser."','".$mesaj."')");
    if($mesajat){
        header("Location: index.php?sayfa=mesajlar&id=".$touser);
    }else{echo"olmadı";}
}
?><div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mesaj Kutusu
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">

          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"> Mesaj Geçmişi</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                  
                <?php 
                    foreach($mylinks as $bagid){
                        echo('<li><a href="index.php?sayfa=mesajlar&id='.$bagid.'"><i class="fa fa-circle-o text-green"></i> <span>'.kulladBul($baglanti,$bagid).'</span></a></li>
                        ');
                    }
                ?>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <?php 
        if($conid != ""){
            
        
        ?>
        <div class="col-md-9">
          <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <h3><?php echo(kulladBul($baglanti,$conid)); ?> ile mesajlaşma geçmişi</h3>
                <h5>Kimden: <?php echo($kullAd); ?>
                  <span class="mailbox-read-time pull-right">15 Feb. 2016 11:03 PM</span></h5>
              </div>
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
              <?php 
              while($nine = $findcon->fetch_assoc()){
                if($nine["fromuser"] == $kullID){
                    echo('
                    
                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                          <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">'.$kullAd.'</span>
                            <span class="direct-chat-timestamp pull-left">'.$nine["date"].'</span>
                          </div>
                          <!-- /.direct-chat-info -->
                          <img class="direct-chat-img" src="'.$kullPP.'" alt="Message User Image"><!-- /.direct-chat-img -->
                          <div class="direct-chat-text pull-right">
                            '.htmlspecialchars($nine["message"]).'
                          </div>
                          <!-- /.direct-chat-text -->
                        </div>
                    ');
                }else{
                    echo('
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">'.kulladBul($baglanti,$nine["fromuser"]).'</span>
                        <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                      </div>
                      <!-- /.direct-chat-info -->
                      <img class="direct-chat-img" src="'.ppBul($baglanti,$nine["fromuser"]).'" alt="Message User Image"><!-- /.direct-chat-img -->
                      <div class="direct-chat-text pull-left">
                        '.htmlspecialchars($nine["message"]).'
                      </div>
                    </div>');
                }
              }
              ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form method="post" action="index.php?sayfa=mesajlar&id=<?php echo($conid); ?>">
                    <div class="input-group">
                        <input type="text" placeholder="Mesaj Yazmaya Başla..." name="mtext" class="form-control"/>
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Gönder</button>
                      </span>
                    </div>
                </form>
            </div>
          </div>
          <?php 
          }
          ?>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>