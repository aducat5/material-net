<?php
//sürekli gerekli header
echo('
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>'); 
            if(isset($_GET["sayfa"])){
                $sayfa = $_GET["sayfa"];
                if($sayfa=="index"){echo"Anasayfa | MaterialNET";
                }elseif($sayfa=="kesfet"){echo('Keşfet | MaterialNET');
                }elseif($sayfa=="mesajlar"){echo('Mesajlar | MaterialNET');
                }elseif($sayfa=="ayarlar"){echo('Ayarlar | MaterialNET');
                }elseif($sayfa=="profil"){echo('Profil | MaterialNET');
                }elseif($sayfa=="adminuye" && yetkilimi($baglanti, $kullID)){echo('Üye Yönetimi | MaterialNET');
                }elseif($sayfa=="adminpost" && yetkilimi($baglanti, $kullID)){echo('Gönderi Yönetimi | MaterialNET');
                }elseif($sayfa=="adminanket" && yetkilimi($baglanti, $kullID)){echo('Anket Yönetimi | MaterialNET');
                }elseif($sayfa=="post"){echo($postTitle." | MaterialNET");
                }else{echo"404 | MaterialNET";}
            }else{echo"Anasayfa";}
          echo('</title>
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">

'); 
if(isset($_GET["sayfa"])){
    if($_GET["sayfa"]=="index"){
    }elseif($sayfa=="kesfet"){
    }elseif($sayfa=="mesajlar"){echo('');
    }elseif($sayfa=="profil"){
    }elseif($sayfa=="ayarlar"){echo('');
    }elseif($sayfa=="admin"){echo('  
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
  ');
    }else{echo('');}
}else{echo('');}
echo('
');
?>