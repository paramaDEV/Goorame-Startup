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
$data2=$conn->selectData("SELECT * FROM riwayat_user WHERE id_user='$iduser';");

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
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="stylesheet" href="../css/riwayat.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <title>Riwayat</title>
</head>
<body>
    <div class="sidebar">
        <center><img class="profile" src="../userimage/<?=$conn->cekGambar($data[0]['profile']);?>" width="100px" height="100px" style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data[0]["nama"]?></h4></center>
        <center><h5 class= "level" style="background-color:<?php echo $conn->cekLevel($data[0]["level"])?>"><?=$data[0]["level"]?></h5></center>
        <div class="menu" style="margin-top:100px;">
            <a href="homeUser.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="keranjang.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Keranjang <?=$conn->hitungKeranjang($iduser)?></h4></a>
            <a href="riwayat.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="accountUser.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <center><h1 style="margin-top:50px">Riwayat</h1></center>
        <center><table border="0" cellspacing=0 cellpadding=10>
            <tr>
                <td>Tanggal</td>
                <td>Item</td>
                <td>Jumlah</td>
                <td>Biaya</td>
            </tr>
            <?php 
            $no=1;
            foreach($data2 as $x):
            ?>
            <tr>
                <td><?=$x["tanggal"]?></td>
                <td><?=$x["item"]?></td>
                <td><?=$x["jumlah"]." Kg"?></td>
                <td><?="Rp ".$conn->rupiah($x["harga"])?></td>
            </tr>
            <?php
            $no++;
            endforeach;
            ?>
        </table></center>
    </div>      
</body>
</html>