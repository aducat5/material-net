<?php 
session_start();
include("inc/baglanti.php");
if(isset($_GET["regAcc"]) && isset($_POST["email"])){
    $mail = $baglanti->real_escape_string($_POST["email"]);
    $pass1 = $baglanti->real_escape_string($_POST["pass1"]);
    $pass2 = $baglanti->real_escape_string($_POST["pass2"]);
    if($pass1 == $pass2){//şifreler uyuşuyor mu?
        $pass = sha1($pass1);//şifreye şifrele
        $passBas = substr($pass,0,-20);//ilk20
        $passSon = substr($pass,20);//son20
        $uyesorgusu1 = $baglanti->query("insert into user(userMail, userPass1, userPass2, userTag) values('".$mail."','".$passBas."','".$passSon."','".time()."')");
        if($uyesorgusu1){
            $_SESSION["mail"]=$mail;
        }else{header("Location:register.php?mailayni");}
    }else{echo"olmadı hocam şifreler uyuşmuyor";}
}elseif(isset($_GET["regDone"]) && isset($_POST["adsoyad"])){
    $hemail = $_SESSION["mail"];
    $adsoyad = $baglanti->real_escape_string($_POST["adsoyad"]);
    $dgm = $baglanti->real_escape_string($_POST["dgm"]);
    $tel = $baglanti->real_escape_string($_POST["tel"]);
    $unvanid = $_POST["unvan"];
    $mailbas = explode("@",$hemail);
    $hangiuye = $baglanti->query("select iduser from user where userMail='".$hemail."'");
    while($idoku = $hangiuye->fetch_assoc()){
        $id = $idoku["iduser"];
        $userTag = $mailbas[0].$id;
        echo($id.$userTag."ve dahası");
    }
    echo($mail);
    $uyesorgusu2 = $baglanti->query("insert into userinfo(idUser,userName,userTitle,userPhone,userBirth) 
    values('".$id."','".$adsoyad."','".$unvanid."','".$tel."','".$dgm."')");
    $usorgu1up = $baglanti->query("update user set userTag = '".$userTag."' where iduser = '".$id."'");
    if($uyesorgusu2){
        if($usorgu1up){
            unset($_SESSION["mail"]);
            header("Location:login.php?oldu");   
        }else{echo"aplayamadık";}
    }else{echo"info olmadı";}
    echo"çıktım";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MaterialNET'e Kayıt Ol!</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Material</b>NET</a>
  </div>

  <div class="register-box-body">

    <?php 
    if(isset($_GET["regAcc"])){
        echo('
    <p class="login-box-msg">Şimdi de profilini oluştur</p>
    <form action="register.php?regDone" method="post">
      <b>Ad Soyad</b>
      <div class="form-group has-feedback">
        <input type="text" required="true" name="adsoyad" class="form-control" placeholder="Adınız ve Soyadınız"/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <b>Doğum Tarihi</b>
      <div class="form-group has-feedback">
        <input type="date" required="true" name="dgm" class="form-control" placeholder="Doğum Tarihi"/>
        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
      </div>
      <b>Ünvan</b>
      <div class="form-group has-feedback">
        <select class="form-control" name="unvan" required="true">
            <option value="">Lütfen Ünvan Seçiniz</option>');
            $unvarlar = $baglanti->query("select * from titles");
            while($unvanoku = $unvarlar->fetch_assoc()){
                echo("
                <option value='".$unvanoku["idtitle"]."'>".$unvanoku["titleName"]."</option>");
            }
            echo('
        </select>
      </div>
      <b>Telefon Numarası</b>
      <div class="form-group has-feedback">
        <input required="true" type="tel" name="tel" class="form-control" /><!--SERKAN TELEFON VALİDASYONU -->
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Kaydı Tamamla!</button>
        </div>
        <!-- /.col -->     
      </div>
    </form>');
    }else{
        echo('
    <p class="login-box-msg">Yeni bir hesap açalım</p>
    <form action="register.php?regAcc" method="post">
      <div class="form-group has-feedback">
        <input type="email" required="true" name="email" class="form-control" placeholder="E-Posta Adresiniz"/>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" required="true" name="pass1"  class="form-control" placeholder="Şifreniz"/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" required="true" name="pass2"  class="form-control" placeholder="Şifrenizi Yeniden Girin"/>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" required="true" name="terms" /><a href="#"> Kullanıcı hakları sözleşmesi</a>ni kabul ediyorum.
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-5">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Devam Et</button>
        </div>
        <!-- /.col -->*      
      </div>
    </form>
    <br />
    <a href="login.php" class="text-center">Zaten bir üyeliğim var</a>
        ');
    }
    ?>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html> 
