<?php
    include "inc/baglanti.php";
    if(!$_GET['sifredegistir']){
        header("Location:login.php");
    }
    else{
        $kod = $_GET['sifredegistir'];
        echo $kod;
        $sorguDogru = "SELECT * FROM sif_hatirlat WHERE sif_Kod = '".$kod."'";
        $sonucDogru = $baglanti->query($sorguDogru);
        if(!mysqli_num_rows($sonucDogru) > 0){
            header("Location:login.php");
        }
    
    if($_GET['yolla'] == "true"){
        if(isset($_POST['ksif1']))
            if($_POST['ksif1'] == $_POST['ksif2']){
                $sorguMail = "SELECT k_mail FROM sif_hatirlat  where sif_Kod = '".$kod."'";
                $sonucMail = $baglanti->query($sorguMail);
                $okuMail = mysqli_fetch_row($sonucMail);
                $mail = $okuMail[0];
                $sif1 = $baglanti->real_escape_string($_POST['ksif1']);
                $pass = sha1($sif1);//şifreye şifrele
                    $passBas = substr($pass,0,-20);//ilk20
                    $passSon = substr($pass,20);//son20
                $sorguDegistir = "UPDATE user SET userPass1 = '".$passBas."', userPass2 = '".$passSon."' WHERE userMail = '".$mail."'";
                $sonucDegistir = $baglanti->query($sorguDegistir);
                if($sonucDegistir)
                {   
                    //echo "guncelledim".$kmail;
                    $sorgu3 = $baglanti->query("DELETE FROM sif_hatirlat where sif_Kod = '".$kod."'");
                    if($sorgu3)
                    {
                        header("Location: login.php?guncelledim=oldu");
                    }else{
                        //echo "silemedim";
                    }
                }else{
                    //echo"güncelleyemedim";
                }
            }
    }}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MaterialNET'e Giriş Yap!</title>
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

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">

    </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Material</b>NET</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <?php
        if(isset($_GET["aktiv"]))
            echo '<p class="login-box-msg bg-info"><br />Aktivasyon maili gönderilmiştir! <br /> Aktivasyon mailinin size ulaşması 5dk sürebilir.</p><br />';
        elseif(isset($_GET["aktivdegil"]))
            echo '<p class="login-box-msg bg-red"><br />Aktivasyon işleminiz tamamlanmamıştır!<br />Mail adresinizi kontrol edin.</p><br />';
        elseif(isset($_GET["aktifok"]))
            echo '<p class="login-box-msg bg-green"><br />Aktivasyon işleminiz tamamlanmıştır!<br />Lütfen giriş yapınız</p><br />';
        elseif(isset($_GET["guncelledim"]))
            echo '<p class="login-box-msg bg-green"><br />Şifreniz başarıyla güncellendi.<br />Giriş yapabilirsiniz</p><br />';
        else
            echo '<p class="login-box-msg">MaterialNet Şifremi Unuttum</p><br />';
        ?>
		<form role="form" action="unuttum.php?yolla=true&sifredegistir=<?php echo $kod; ?>" method="post" class="l-form">
        	<div class="form-group">
        		<label class="sr-only" for="l-form-username">Yeni Şifre</label>
            	<input type="password" name="ksif1" placeholder="Yeni Şifre..." class="l-form-password form-control" id="l-form-password" data-validation="length" data-validation-length="min8" data-validation-error-msg="<label class='bg-white'>Şifre Alanı 8 Karakterden Kısa Olamaz!</label>">
            </div>
            <div class="form-group">
            	<label class="sr-only" for="l-form-password">Yeni Şifre Tekrar</label>
            	<input type="password" name="ksif2" placeholder="Yeni Şifre Tekrar..." class="l-form-password form-control" id="l-form-password" data-validation="length" data-validation-length="min8" data-validation-error-msg="<label class='bg-white'>Şifreler Uyuşmalıdır</label>">
            </div>
            <button type="submit" class="btn">Şifremi Güncelle</button>
            <br />
    	</form>

        <div class="row">
            <div class="col-xs-6">
                <a href="login.php">Giriş Yapmak İstiyorum</a>
            </div>
            <div class="col-xs-6">
                <a href="register.php">Üye Olmak İstiyorum</a>
            </div>
        </div>


        <br />
        <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
<script>
    $.validate({
        lang: 'es'
    });
</script>


</body>
</html>
