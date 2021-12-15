<?php
    include "inc/baglanti.php";
    if(!$_GET['sifredegistir']){
        header("Location:login.php");
    }
    else{
        $kod = $_GET['sifredegistir'];
    }
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BB Hayvancılık</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets2/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets2/css/form-elements.css">
        <link rel="stylesheet" href="assets2/css/style.css">
        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css"
              rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets2/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets2/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets2/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets2/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets2/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	<div class="container">
                	
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1>BB Hayvancılık Yatırım Ortaklığı</h1>
                        <div class="description">
                        	<p>

                        	</p>
                        </div>
                    </div>
                </div>
                
                
                
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
						<form role="form" action="unuttum.php?yolla=true" method="post" class="l-form">
	                    	<div class="form-group">
	                    		<label class="sr-only" for="l-form-username">Yeni Şifre</label>
	                        	<input type="password" name="ksif1" placeholder="Yeni Şifre..." class="l-form-password form-control" id="l-form-password" data-validation="length" data-validation-length="min8" data-validation-error-msg="<label class='bg-white'>Sifre Alani Bos Birakilamaz!</label>">
	                        </div>
	                        <div class="form-group">
	                        	<label class="sr-only" for="l-form-password">Yeni Şifre Tekrar</label>
	                        	<input type="password" name="ksif2" placeholder="Yeni Şifre Tekrar..." class="l-form-password form-control" id="l-form-password" data-validation="length" data-validation-length="min8" data-validation-error-msg="<label class='bg-white'>Sifre Alani Bos Birakilamaz!</label>">
	                        </div>
				            <button type="submit" class="btn">Şifremi Güncelle</button>
                            <br />
				    	</form>
                    </div>
                    <div class="col-sm-6 forms-right-icons">
						<div class="row">
							<div class="col-sm-2 icon"><i class="fa fa-user"></i></div>
							<div class="col-sm-10">
								<h3>Lütfen unutmayacağınız, en az 8 karakter ve sayı kullanınız.</h3>
							</div>
						</div>
                    </div>
                </div>
                    
        	</div>
        </div>

        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p><a href="http://slothdevelopment.com" target="_blank">Sloth Development</a> bünyesinde gelistirilmistir.</p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="assets2/js/jquery-1.11.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
        <script src="assets2/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets2/js/jquery.backstretch.min.js"></script>
        <script src="assets2/js/scripts.js"></script>
        <script>
            $.validate({
                lang: 'en',
                modules: 'sanitize'
            });
        </script>
        <!--[if lt IE 10]>
            <script src="assets2/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>