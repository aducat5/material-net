<?php

$serverip = "94.73.151.71"; //ip tanımla

$serverkull = "mnet_admin"; //kullanıcı adı tanımla

$serversiff = '_&vqPV56~25K'; //şifre gir

$dbad = "mnet_database"; //veritabanı adı tanımla



$baglanti = new mysqli($serverip, $serverkull, $serversiff, $dbad); //baglantı oluştur.



if ($baglanti->connect_error) { //kontrol et

    die("Connection failed: " . $baglanti->connect_error);

}



mysqli_error($baglanti);

$baglanti->set_charset("utf8")

?>