<?php
session_start();
require 'Functions.php';
if(!isset($_SESSION["status"])){
    header("location:index.php");
    exit;
}else if($_SESSION["status"]!="user"){
    header("location:index.php");
    exit;
}
$iduser=$_SESSION["iduser"];
$data=$conn->selectData("SELECT * FROM user WHERE id='$iduser'");
$data2=$conn->selectData("SELECT * FROM mitra");


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
    <link rel="stylesheet" href="../css/homeUser.css">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/homeUser.js"></script>
    <title>Dahboard User</title>
</head>
<body>
<img src="../assets/blue-humberger.jpg" class="hamburger">
    <div class="sidebar">
        <center><img class="profile" src="../userimage/<?=$conn->cekGambar($data[0]['profile']);?>"   style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data[0]["nama"]?></h4></center>
        <center><h5 class="level" style="background-color:<?php echo $conn->cekLevel($data[0]["level"])?>"><?=$data[0]["level"]?></h5></center>
        <div class="menu">
            <a href=""><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="keranjang.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Keranjang <span style="position:absolute;"><?=$conn->hitungKeranjang($iduser)?></span></h4></a>
            <a href="riwayat.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="accountUser.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
    <input type="hidden" id="iduser" value="<?=$iduser?>">
        <center><h1 style="margin-top:50px">Mau beli apa hari ini ?</h1></center>
        <center><div class="search" ><input id="searchField" autocomplete=off placeholder="Ketikkan nama ikan" type="text" style="font-style:italic;text-align:center;"></div></center>
        <center><div class="result">
            <?php
            foreach($data2 as $x):
            ?>
        <div class="kotak">
        <div class="gambar">
            <img src="../mitraimage/<?=$x["sampul"]?>" >
        </div>
        
        <center><h4 style="color: rgb(22, 22, 22);"><?=$x["nama_usaha"]?></h4></center>
        <h5 style="font-family: 'Open Sans',sans-serif;line-height:18px;margin-bottom:2px"><?=$x["alamat"]?></h5>
        <center><?php $conn->showStar(4)?></center>
        <h5 style="font-family: 'Open Sans',sans-serif;">Jam Operasional :<?=$x["jam_operasional"]?></h5>
        <center><a href="lapak.php?idmitra=<?=$x['id']?>&iduser=<?=$iduser?>"><button>Kunjungi Lapak</button></a></center>
        </div>
        <?php endforeach;?>
        </div>
        
    </center>
    </div>
</body>
</html>