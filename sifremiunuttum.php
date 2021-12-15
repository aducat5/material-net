<!DOCTYPE html>
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
        <form id="exm1" action="smtp/mail.php" method="post">
            <div class="form-group has-feedback">
                <input id="email" type="text" class="form-control" placeholder="E-mail Adresi" name="userMail" data-validation="email" data-validation-error-msg="Mail adresinizi kontrol ediniz!">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Şifremi Hatırlat</button>
                </div>
            </div>
            <div class="row">
                <br />
            </div>
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
