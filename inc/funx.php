<?php
function GetIP(){
	if(getenv("HTTP_CLIENT_IP")) {
 		$ip = getenv("HTTP_CLIENT_IP");
 	} elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 		$ip = getenv("HTTP_X_FORWARDED_FOR");
 		if (strstr($ip, ',')) {
 			$tmp = explode (',', $ip);
 			$ip = trim($tmp[0]);
 		}
 	} else {
 	$ip = getenv("REMOTE_ADDR");
 	}
	return $ip;
}

function sessionCheck($baglanti){
    if(!isset($_SESSION["loghed"])){//oturum ne alemde?
        header("Location: login.php");
    }else {//açıksa bunları yap
            $kmail = $_SESSION["loghed"];
            $check1 = "SELECT * FROM user WHERE userMail = '" . $kmail . "'";
            $sonuc1 = $baglanti->query($check1);
            while ($oku1 = $sonuc1->fetch_assoc()) {
                $sesId = $oku1["userSesID"];
                //$sorguUserInfo = "COUNT(*) as sayi from userinfo where idUser = '" . $oku1["iduser"] . "'";$sonucUserInfo = $baglanti->query($sorguUserInfo);if($sonucUserInfo["sayi"] <= 0){header("Location: index.php?sayfa=userInfo");}

            }
            if ($sesId != session_id()) {//iki kişi aynı anda giremez.
                logoutOlayi();
            }
    }
    header( "Refresh:1800; url=index.php?islem=logout");
    
}

function logoutOlayi(){
    unset($_SESSION["loghed"]);
    header("Location: login.php?cikti");
}

function oyla($baglanti, $kid, $sid, $said){
    $oyversorgu = $baglanti->query("update surveyanswer set surveyAnsed = surveyAnsed +1 where
    idsurveyAnswer = '".$said."' and surveyID = '".$sid."'");
    $oyladim = $baglanti->query("update userinfo set userAnsd = 1 where idUser = '".$kid."' ");
    if($oyversorgu && $oyladim){header("Location:index.php");}else{echo"bi'sıkıntı var";}
}

function yetkilimi($baglanti,$kid){
    $ausorgu = $baglanti->query("select userAuth from user where iduser = '".$kid."'");
    $auku = mysqli_fetch_row($ausorgu);
    if($auku[0]==1){
        $auth = true;
    }else{
        $auth = false;
    }
    return $auth;
}

function ozet($string, $wordsreturned)
    /*  Returns the first $wordsreturned out of $string.  If string
    contains fewer words than $wordsreturned, the entire string
    is returned.
    */
    {
    $retval = $string;      //  Just in case of a problem
     
    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)
    /*  Already short enough, return the whole thing
    */
    {
    $retval = $string;
    }
    else
    /*  Need to chop of some words
    */
    {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array)." ...";
    }
    return $retval;
}
function uzantiDondur($postExt){
    if($postExt == "png" || $postExt == "jpg"){return 1;}
    elseif($postExt == "avi" || $postExt == "mp4"){return 2;}
    elseif($postExt == "pdf" || $postExt == "docx" || $postExt == "xslx" || $postExt == "pptx" || $postExt == "txt"){return 3;}
    elseif($postExt == "mp3" || $postExt == "waw"){return 4;}
    elseif($postExt == "ytb"){return 5;}
}



function uzantiResim($postFile){
    $postExt = uzantiBul($postFile);
    $uzanti = uzantiDondur($postExt);
    if($uzanti == 1){return("fa fa-photo text-green fa-5x");
                      }elseif($uzanti == 2){return("fa fa-video-camera text-yellow fa-5x");
                      }elseif($uzanti == 3){return("fa fa-file-text-o text-blue fa-5x");
                      }elseif($uzanti == 4){return("fa fa-file-text-omicrophone text-purple fa-5x");
                      }elseif($uzanti == 5){return("fa fa-youtube-play text-red fa-5x");}
}

function postTurYaz($postFile){
    $uzanti = uzantiBul($postFile);
    $postExt = uzantiDondur($uzanti);
    if($postExt == 1){return("görsel");
    }elseif($postExt == 2){return("video");
    }elseif($postExt == 3){return("ofis/belge");
    }elseif($postExt == 4){return("ses");
    }elseif($postExt == 5){return("youtube video");}
}

function postTurLinkback($postFile){
    $uzanti = uzantiBul($postFile);
    $postExt = uzantiDondur($uzanti);
    if($postExt == 1){return("index.php?sayfa=kesfet&ptip=jpg,png");
    }elseif($postExt == 2){return("index.php?sayfa=kesfet&ptip=mp4,avi");
    }elseif($postExt == 3){return("index.php?sayfa=kesfet&ptip=pdf,docx,xlsx,pptx,txt");
    }elseif($postExt == 4){return("index.php?sayfa=kesfet&ptip=mp3,waw");
    }elseif($postExt == 5){return("index.php?sayfa=kesfet&ptip=ytb");}
}

function yorumYazdir($baglanti,$postID){
    $yorums = $baglanti->query("select * from comment where postID = '".$postID."' order by idcomment desc limit 4");
    if(mysqli_num_rows($yorums)>0){
      while($yorumoku = $yorums->fetch_assoc()){
        $commerID = $yorumoku["userid"];
        $comText = $yorumoku["comText"];
        $comDT = $yorumoku["comDate"];
        $comSahip = kulladBul($baglanti,$commerID);
        echo('
        <i class="fa fa-comments text-yellow"></i> '.$comSahip.' : '.$comText.'<br />
        ');
      } 
    }else{echo"Yorum bulunamadı, ayrıntılara giderek ilk yorumu yapabilirsiniz.";}
}

function getFeed($baglanti,$fTag){ 
    $yazilanlarDegisken = 0;
    global $kullTag;
    if($fTag == $kullTag){
        $benimp = 1;
    }else{
        $benimp = 0;
    }
    $FooTags = explode(",",$fTag);
    $postSorgu = $baglanti->query("select * from posts where postPub = 1 order by idpost desc");
    while($oku = $postSorgu->fetch_assoc()){
        $postAyir = explode(",",$oku["postTag"]);
        $y = 0;
        foreach($FooTags as $fotags){ 
            if(in_array($fotags,$postAyir)){
                $saat = dtsaatDuzelt($oku['postDT']);
                $postSahibi = kulladBul($baglanti,$oku['iduser']);
                $uzantiIcon = uzantiIcon($oku['postFile']);
                $postTur = postTurYaz($oku['postFile']);
                $uzantiResim = uzantiResim($oku['postFile']);
                $postID = $oku['idpost'];
                echo '<li>
                    <i class="'.$uzantiIcon.'"></i>
    
                    <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> '.$saat.'</span>
                    ';
                    if($benimp){
                    echo'<span class="time"><i class="fa fa-remove"></i> Kaldır</span>
                    <span class="time"><i class="fa fa-edit"></i> Düzenle</span>';    
                    }
                    
                    echo'<h3 class="timeline-header"><a href="index.php?sayfa=profil&ktag='.userTagbul($baglanti,$oku['iduser']).'">'.$postSahibi.'</a> bir <a href="'.postTurLinkback($oku['postFile']).'">'.$postTur.' </a>materyal paylaştı</h3>
    
                        <div class="timeline-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="index.php?sayfa=post&postid='.$oku['idpost'].'"><h4>'.$oku['postTitle'].'</h4></a>
                                        &nbsp;&nbsp;&nbsp;<i class="'.$uzantiResim.'"></i>
                                </div>
                                <div class="col-md-9">
                                    <h4>Son Yorumlar</h4>
                                    ';
                                    $yorums = $baglanti->query("select * from comment where postID = '".$postID."' order by idcomment desc limit 4");
                                    if(mysqli_num_rows($yorums)>0){
                                      while($yorumoku = $yorums->fetch_assoc()){
                                        $commerID = $yorumoku["userid"];
                                        $comText = $yorumoku["comText"];
                                        $comDT = $yorumoku["comDate"];
                                        $comSahip = kulladBul($baglanti,$commerID);
                                        echo('
                                        <i class="fa fa-comments text-yellow"></i> <a href="index.php?sayfa=profil&ktag='.userTagbul($baglanti,$commerID).'">'.$comSahip.'</a> : '.htmlspecialchars($comText).'<br />
                                        ');
                                      } 
                                    }else{echo"Yorum bulunamadı, ayrıntılara giderek ilk yorumu yapabilirsiniz.";} 
                                    echo '
                                </div>
                            </div>
                        </div>
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs" href="index.php?sayfa=post&postid='.$oku['idpost'].'">Ayrıntılar</a>&nbsp';
                            $uzanti = uzantiBul($oku['postFile']);
                        if (uzantiDondur($uzanti) != 5)
                        echo'<a class="btn btn-success btn-xs" download href ='.$oku['postFile'].'>İndir</a>';
                        echo'        
                        </div>
                    </div>
                </li>';
            break;
            }
            
            
            $y++;
        }
    }
}

//çeviri fonksiyonları

function userTagbul($baglanti, $kid){
      $tagla = $baglanti->query("select userTag from user where iduser = '".$kid."'");
      while($tagoku = $tagla ->fetch_assoc()){
        $kullTag = $tagoku["userTag"];
      }
      return $kullTag;
      
}

function uzantiBul($postFile){
    $postExp = explode(".",$postFile);
    $postExt = end($postExp);
    
    if($postExt == "jpg" || $postExt == "pdf" || $postExt == "docx" || $postExt == "xslx" || $postExt == "avi" || $postExt == "mp4" || $postExt == "png" || $postExt == "mp3"){
        
    }elseif(strpos($postExt, 'com/embed') !== false){
        $postExt = "ytb";
    }
    
    return $postExt;
}

function kulladBul($baglanti,$id){
    $adsorgu = $baglanti->query("select userName from userinfo where idUser='".$id."'");
    while($adoku = $adsorgu->fetch_array()){
        $adineymis = $adoku["userName"];
    }
    return $adineymis;
}

function ppBul($baglanti,$kid){
    $ppsorgu = $baglanti->query("select userPP from userinfo where idUser = '".$kid."'");
    while($PPoku = $ppsorgu->fetch_array()){
        $ppneymis = $PPoku["userPP"];
    }
    if($ppneymis == ""){
      $ppneymis = "dist/img/pps/defpp.png";
    }
    return $ppneymis;
}

function unvanbul($baglanti, $uno){
    
    $unvanla = $baglanti->query("select * from titles where idtitle = '".$uno."'");
    while($unoku = $unvanla ->fetch_assoc()){
        $kullUnvan = $unoku["titleName"];
    }
    return $kullUnvan;
}

function idtounvan($baglanti, $id){
    $sorgu = $baglanti->query("select titleName from titles where idtitle = (select userTitle from userinfo where idUser = '".$id."')");
    $oku = mysqli_fetch_row($sorgu);
    $yaz = $oku[0];
    return $yaz;
}
function uzantiIcon($postFile){
    $postExt = uzantiBul($postFile);
    $uzanti = uzantiDondur($postExt);
    if($uzanti == 1){return("fa fa-photo bg-green");
    }elseif($uzanti == 2){return("fa fa-video-camera bg-yellow");
    }elseif($uzanti == 3){return("fa fa-file-text-o bg-blue");
    }elseif($uzanti == 4){return("fa fa-file-text-omicrophone bg-purple");
    }elseif(5){return("fa fa-youtube-play text-red");}
} 

function dtsaatDuzelt($dt){
    $ex1dt = explode(" ",$dt);
    $saat = substr($ex1dt[1],0,5);
    return $saat;
}

function ktagtoid($baglanti, $userTag){
      $idle = $baglanti->query("select iduser from user where userTag = '".$userTag."'");
      while($idoku = $idle->fetch_assoc()){
        $id = $idoku["iduser"];
      }
      return $id;
}

function dgmtogay($dgm){
    $ts = explode(" ",$dgm);
    return $ts[0];
}

function getLinked($kid){
    global $baglanti;
    $userTag = userTagbul($baglanti,$kid);
    
    $followingTags = $baglanti->query("SELECT userFtag from userinfo WHERE idUser = '".$kid."'");
    $followingTagsOku = mysqli_fetch_row($followingTags);
    $following = explode(",",$followingTagsOku[0]);
    foreach($following as $following){
        $isthataUser = $baglanti->query("SELECT iduser from user WHERE userTag = '".$following."'");
        while($oku = $isthataUser->fetch_assoc()){
            $sonuc = $oku['iduser'];
            $isUserFMe = $baglanti->query("SELECT userFtag from userinfo WHERE idUser = '".$sonuc."'");
            $isUserFoMe = mysqli_fetch_row($isUserFMe);
            $following2 = explode(",",$isUserFoMe[0]);
            foreach($following2 as $following2){
                if($following2 == $userTag){
                    $users .= " ".$oku["iduser"];
                }
            }
        }
    }
    return $users;
}

function IPSayaci($baglanti){
    $sayacSorgu = $baglanti->query("SELECT Count(Distinct(userip)) FROM log");
    $oku = mysqli_fetch_row($sayacSorgu);
    return $oku[0];
}

function tarihduzelt($tarih)
{
    $dizitarih = explode(" ",$tarih);
    $yazim = explode("-",$dizitarih[0]);
    $dizisaat = explode(":",$dizitarih[1]);
    $sontarih = $yazim[2] . '-' . $yazim[1] . '-' . $yazim[0] . ' / ' .  $dizisaat[0] . ':' . $dizisaat[1];
    
    return $sontarih;
}

function SonLogIn($baglanti,$kid){
    $sorgu = $baglanti->query("SELECT lastLog FROM log where idUser = '".$kid."' ORDER BY lastLog DESC limit 1");
    $sonuc = mysqli_fetch_row($sorgu);
    $sonuc = tarihduzelt($sonuc[0]);
    return $sonuc;
}

?>