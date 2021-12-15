<?php
    session_start();
    ob_start();
    include("inc/baglanti.php");
    include("inc/funx.php");
    sessionCheck($baglanti);
    if(!isset($_GET["sayfa"])){header("Location:index.php?sayfa=index");}else{$sayfa = $baglanti->real_escape_string($_GET["sayfa"]);}
    $kmail = $_SESSION["loghed"];
    $bilgilericek = $baglanti->query("select * from userinfo where idUser = (select iduser from user where userMail = '".$kmail."' )");
      while($bilgioku = $bilgilericek->fetch_assoc()){
          $kullID = $bilgioku["idUser"];
          $kullAd = $bilgioku["userName"];
          $kuid = $bilgioku["userTitle"];
          $kullTel = $bilgioku["userPhone"];
          $kullDgm = $bilgioku["userBirth"];
          $kullPP = $bilgioku["userPP"];
          $kullttag = $bilgioku["userFtag"];
          $kullAnsd = $bilgioku["userAnsd"];
          $kullUnvan = unvanbul($baglanti,$kuid);
          $kullTag = userTagbul($baglanti, $kullID);
          if($kullPP == ""){
            $kullPP = "dist/img/pps/defpp.png";
          }
          $kullFTag = explode(",",$kullttag);
      }
    if(isset($_GET["cikis"])){logoutOlayi();}
    if(isset($_GET["postid"])){
        $postidic = $baglanti->real_escape_string($_GET["postid"]);
        $postsoric = $baglanti->query("select * from posts where idpost = '".$postidic."'");
        while($postokuic = $postsoric->fetch_assoc()){  
            $postTitle = $postokuic["postTitle"];
            $iduser = $postokuic["iduser"];
            $postTag = $postokuic["postTag"];
            $postDT = $postokuic["postDT"];
            $postDefi = $postokuic["postDefi"];
            $postFile = $postokuic["postFile"];
        }
        $postExt = uzantiBul($postFile);
        $kullicPP = ppBul($baglanti,$iduser);
        if(isset($_POST["postext"])){
            $commerID = $baglanti->real_escape_string($_GET["pcomid"]);
            $comtext = $baglanti->real_escape_string($_POST["postext"]);
            $yorumla = $baglanti->query("insert into comment(userid, comText, postID) 
            values('".$commerID."', '".$comtext."', '".$postidic."')");
            if($yorumla){header("Location: index.php?sayfa=post&postid=".$postidic."&oldu");}
        }
    }
    
    $mylink = trim(getLinked($kullID));
    $mylinks = explode(" ",$mylink);
?>
<!DOCTYPE html>
<html>
<head>
    <?php include("inc/header.php"); ?>
</head>
<body class="hold-transition skin-red-light sidebar-mini <?php if($sayfa!="index" && $sayfa!="ayarlar"){echo"sidebar-collapse";}?> layout-boxed">
<div class="wrapper">
  <!-- Sol ve üst navigasyon barları -->
  <?php include("inc/bars.php"); ?>  
  
  <!-- İçerikler -->
    <?php
        if(isset($_GET["sayfa"])){
            if($sayfa=="index"){include("inc/sayfalar/index.php");
            }elseif($sayfa=="kesfet"){include("inc/sayfalar/kesfet.php");
            }elseif($sayfa=="mesajlar"){include("inc/sayfalar/mesajlar.php");
            }elseif($sayfa=="ayarlar"){include("inc/sayfalar/ayarlar.php");
            }elseif($sayfa=="profil"){include("inc/sayfalar/profil.php");
            }elseif($sayfa=="post"){include("inc/sayfalar/post.php");
            }elseif($sayfa=="adminuye" && yetkilimi($baglanti, $kullID)){include("inc/sayfalar/adminuye.php");
            }elseif($sayfa=="adminpost" && yetkilimi($baglanti, $kullID)){include("inc/sayfalar/adminpost.php");
            }elseif($sayfa=="adminanket" && yetkilimi($baglanti, $kullID)){include("inc/sayfalar/adminanket.php");
            }//elseif($sayfa=="userInfo"){include("inc/sayfalar/kisiselBilgiler.php");}
            else{include("inc/sayfalar/404.php");}
        }else{include("inc/sayfalar/index.php");} 
    ?>
  
  <!-- footer -->
  <?php include("inc/footer.php"); ?>

</div>
<!-- ./wrapper -->

  <?php include("inc/jscripts.php"); ?>
</body>
</html>
