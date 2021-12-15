<?


 
if(isset($_POST['userMail'])){
    include("../inc/baglanti.php");
    $mail = $_POST['userMail'];
    $sifkod = md5(time());
    $sorgu2 = "INSERT INTO sif_hatirlat (k_mail,sif_Kod) VALUES('".$mail."','".$sifkod."')";
    $sonuc2 = $baglanti->query($sorgu2);
    if($sonuc2){
        echo "tm";
    }else{
        echo$sorgu2;
    }
        
    require("class.phpmailer.php");
    include("language/phpmailer.lang-tr.php");
    $konu = "MaterialNet Şifre Hatırlat";
    
    $mail1 = new PHPMailer();
    $mail1->IsSMTP();                                   // send via SMTP
    $mail1->Host     = "mail.abcdefghijklmnopqrstuw.xyz"; // SMTP servers
    $mail1->SMTPAuth = true;     // turn on SMTP authentication
    $mail1->Username = "info@abcdefghijklmnopqrstuw.xyz";  // SMTP username
    $mail1->Password = "ASdp67L8"; // SMTP password
    $mail1->From     = "info@abcdefghijklmnopqrstuw.xyz"; // smtp kullan�c� ad�n�z ile ayn� olmal�
    $mail1->Port     = 587; 
    $mail1->Fromname = "MaterialNet";
    $mail1->AddAddress($mail,"Degerli Uyemiz");
    $mail1->Subject  =  "MaterialNet Sifre Hatirlatma";
    $mail1->Body     =  "Sifre degistirme linkiniz;\r\n http://abcdefghijklmnopqrstuw.xyz/mnet2/unuttum.php?sifredegistir=".$sifkod." \r\n Eger bu istek sizin tarafinizdan yapilmadiysa lütfen bizimle iletisime geçiniz.";
    
    if(!$mail1->Send()){
       echo "Mesaj Gönderilemedi <p>";
       echo "Mailer Error: " . $mail1->ErrorInfo;
       exit;
    }else{
        header("Location:../login.php?yolla=true");  
    }
}
?>