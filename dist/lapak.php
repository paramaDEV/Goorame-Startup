<?php
session_start();
require 'Functions.php';
if(!isset($_SESSION["status"])){
    header("location:index.php");
    exit;
}else if($_SESSION["status"]!="user"){
    header("location:index.php");
    exit;
}else if(!isset($_GET["iduser"])){
    header("location:index.php");
    exit;
}
$iduser=$_GET["iduser"];
$idmitra=$_GET["idmitra"];
$data=$conn->selectData("SELECT * FROM mitra,komoditi WHERE mitra.id=komoditi.id_mitra AND id_mitra='$idmitra'");
$data2=$conn->selectData("SELECT * FROM user WHERE id='$iduser'");
$bintang=$data[0]["bintang"];

if(isset($_POST["submit"])){
    $conn->tambahKeranjang($_POST);
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="stylesheet" href="../css/lapak.css">
    <title>Lapak</title>
</head>
<body>
    <div class="sidebar">
        <center><img class="profile" src="../userimage/<?=$conn->cekGambar($data2[0]['profile']);?>" width="100px"height="100px" style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data2[0]["nama"]?></h4></center>
        <center><h5 class="level" style="background-color:<?php echo $conn->cekLevel($data2[0]["level"])?>"><?=$data2[0]["level"]?></h5></center>
        <div class="menu" style="margin-top:100px;">
            <a href="homeUser.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="keranjang.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Keranjang <?=$conn->hitungKeranjang($iduser)?></h4></a>
            <a href="riwayat.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="accountUser.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <div class="sampul">
            <center><img src="../mitraimage/<?=$data[0]["profile"]?>"></center>
            <center><h1 style="color:white"><?=$data[0]["nama_usaha"]?></h1></center>
            <center><div class="star"><?php $conn->showStar($bintang)?></div></center>
            <center> <h3 style="color:white;font-family:'Roboto',sans-serif">Alamat : <?=$data[0]["alamat"]?></h3></center>
            <center> <h3 style="color:white;font-family:'Roboto',sans-serif">Jam operasional : <?=$data[0]["jam_operasional"]?></h3></center>
            
        </div>
        <center>
            <div class="result">
            <?php
            foreach($data as $x):
            ?>
                <div class="item">
                    <img src="../mitraimage/<?=$x["gambar"]?>">
                    <center><h2><?=$x["nama_ikan"]?></h2></center>
                    <form action="" method="POST">
                    <center><h3>Harga : Rp <?=$conn->rupiah($x["harga"])?></h3></center>
                    <center><h3 style="font-size:15px;color : RGB(156, 10, 5);">Jumlah : <input required type="number" name="jumlah"> Kg</h3></center>
                        <input type="hidden" name="iduser" value="<?=$iduser?>">
                        <input type="hidden" name="idmitra" value="<?=$idmitra?>">
                        <input type="hidden" name="nmikan" value="<?=$x["nama_ikan"]?>">
                        <input type="hidden" name="harga" value="<?=$x["harga"]?>">
                    <center><button type="submit" name="submit" onclick="return confirm('Apakah anda ingin menambahkan item ini ke keranjang ?');">Beli</button></center>
                    </form>
                </div>
                <?php
                endforeach;
                ?>
        </center>
    </div>
</body>
</html>