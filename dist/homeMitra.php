<?php
session_start();
require 'Functions.php';

if(!isset($_SESSION["status"])){
    header("location:index.php");
    exit;
}else if($_SESSION["status"]!="mitra"){
    header("location:index.php");
    exit;
}
$idmitra=$_SESSION["idmitra"];
$data=$conn->selectData("SELECT * FROM mitra WHERE id='$idmitra'");
$bintang=$data[0]["bintang"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@500&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/homeMitra.css">
    <link rel="shortcut icon" href="../favicon.png">
    <title>Dashboard Mitra</title>
    <script src="../node_modules/chart.js/dist/Chart.js"></script>
    
</head>
<body>
    <div class="sidebar">
        <center><img class="profile" src="../mitraimage/<?=$conn->cekGambar($data[0]['profile']);?>" height="100px" width="100px"style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif">Lorem Ipsum</h4></center>
        <center><?php $conn->showStar($bintang)?></center>
        <div class="menu" style="margin-top:100px;">
            <a href=""><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="pesanan.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Pesanan<span style="margin-left:10px;background-color: red;padding:5px;border-radius:10px;">0</span></h4></a>
            <a href="riwayatMitra.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="komoditi.php"><img src="../assets/komoditi.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Komoditi</h4></a>
            <a href="accountMitra.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <center><h1>Dashboard Mitra</h1></center>
        <canvas id="lineChart" height="100" style="height: 130px;"></canvas>
        <center>   
            <div class="wrap">
                <div class="kotak">
                    <div class="container" style="background-color: rgb(23, 89, 175);"><h1>99</h1><h3>Pesanan aktif </h3></div>
                    <div class="container" style="background-color: rgb(218, 106, 15);" ><h1>99</h1><h3>Pesanan selesai</h3></div>
                    <div class="container" style="background-color: rgb(218, 15, 66);"><h1>99</h1><h3>Ikan terjual (Kg)</h3></div>
                </div>
            </div>
        </center>
    </div>
    <script src="../js/homeMitra.js"></script>
</body>
</html>