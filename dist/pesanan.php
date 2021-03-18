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
$data2=$conn->selectData("SELECT * FROM pesanan WHERE id_mitra='$idmitra'");
$bintang=$data[0]["bintang"];

if(isset($_POST["akhiri"])){
    $conn->akhiriPesanan($_POST);
}

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
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="stylesheet" href="../css/pesanan.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <title>Pesanan Aktif</title>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(()=>{
            $(".hamburger").click(()=>{
            $(".sidebar").toggleClass("active");
            $(".hamburger").toggleClass("active2");
            })
        })
        
    </script>
</head>
<body>
<img src="../assets/blue-humberger.jpg" class="hamburger">
    <div class="sidebar">
        <center><img class="profile"  src="../mitraimage/<?=$conn->cekGambar($data[0]['profile']);?>"  style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data[0]["nama_pemilik"]?></h4></center>
        <center><?php $conn->showStar($bintang)?></center>
        <div class="menu" >
            <a href="homeMitra.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="pesanan.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Pesanan<span style="position:absolute;"><?=$conn->hitungPesanan($idmitra)?></h4></a>
            <a href="riwayatMitra.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="komoditi.php"><img src="../assets/komoditi.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Komoditi</h4></a>
            <a href="accountMitra.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <center><h1 style="margin-top:50px">Pesanan aktif</h1></center>
        <center>
            <div class="tagihan">
            <?php
            $penghasilan=0;
            foreach($data2 as $x):
            ?>
                <div class="item">
                    <div class="kotak" style="line-height: 11px;">
                        <h1>Ikan <?=$x["ikan"]?></h1>
                        <h4>Jumlah : <?=$x["jumlah"]?> Kg</h4>
                        <h4>Total: Rp <?=$conn->rupiah($x["biaya"])?></h4>
                    </div>
                    <div class="kotak">
                        <button><h1>Menunggu diproses</h1></button>
                    </div>
                </div>
            <?php
            
            $penghasilan+=$x["biaya"];
            endforeach ;
            if($data2==null){?>
            <img src='../assets/trolley.png' ><br><h2 style='font-family:Roboto,sans-serif'>Anda belum memiliki pesanan saat ini</h2>
            <?php
            }else{
            ?>
            </div>
            <br>
            <div class="rincian">
                <div class="kotak" style="line-height: 11px;">
                    <h1>Jumlah pesanan saat ini : </h1>
                </div>
                <div class="kotak">
                    <center><h1><?=count($data2)?></h1></center>
                </div>
            </div>
            <div class="rincian">
                <div class="kotak" style="line-height: 11px;">
                    <h1>Penghasilan : </h1>
                </div>
                <div class="kotak">
                    <center><h1><?="Rp".$conn->rupiah($penghasilan)?></h1></center>
                </div>
            </div>
            <form action="" method="POST">
                <input type="hidden" name="idmitra" value="<?=$idmitra?>">
            <button type="submit" name="akhiri" onclick="return confirm('Apakah seluruh proses sudah selesai?')">Selesai Proses</button>
            </form>
            <?php } ?>
    </center>
    </div>
</body>
</html>