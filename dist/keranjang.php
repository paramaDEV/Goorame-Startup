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

if(isset($_POST["checkout"])){
    $conn->checkout($_POST);
}

$iduser=$_SESSION["iduser"];
$data=$conn->selectData("SELECT * FROM user WHERE id='$iduser'");
$data2=$conn->selectData("SELECT * FROM keranjang WHERE id_user='$iduser'");


$hargaTotal=0;
$ongkir=0;
$totalBayar=0;
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
    <link rel="stylesheet" href="../css/keranjang.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <title>Keranjang</title>
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
        <center><h1 style="margin-top:50px">Keranjang</h1></center>
        <center>
            <div class="tagihan">
                <?php
                    if($data2==null){
                        echo "<img src='../assets/trolley.png' height='350px'><br><h2 style='font-family:Roboto,sans-serif'>Anda tidak memiliki belanjaan apapun di keranjang</h2><a href='homeuser.php'><button>Belanja sekarang</button></a>";
                        exit;
                    }else{
                    foreach($data2 as $x):
                ?>
                <div class="item">
                    <div class="kotak" style="line-height: 11px;">
                        <h1>Ikan <?=$x["ikan"]?></h1>
                        <h4>Jumlah : <?=$x["jumlah"]?> Kg</h4>
                    </div>
                    <div class="kotak">
                        <h1>Rp <?=$conn->rupiah($x["biaya"])?></h1>
                    </div>
                </div>
                <?php
                $hargaTotal+=$x["biaya"];
                $ongkir=10000;
                $totalBayar=$ongkir+$hargaTotal;
                endforeach;
            }
                ?>
            </div>
            <br>
            <div class="rincian">
                <div class="kotak" style="line-height: 11px;">
                    <h1>Biaya</h1>
                </div>
                <div class="kotak">
                    <h1>Rp <?=$conn->rupiah($hargaTotal)?></h1>
                </div>
            </div>
            <div class="rincian">
                <div class="kotak" style="line-height: 11px;">
                    <h1>Ongkos kirim : </h1>
                </div>
                <div class="kotak">
                    <h1>Rp <?=$conn->rupiah($ongkir)?></h1>
                </div>
            </div>
            <div class="rincian">
                <div class="kotak" style="line-height: 11px;">
                    <h1>Total pembayaran</h1>
                </div>
                <div class="kotak">
                    <h1>Rp <?=$conn->rupiah($totalBayar)?></h1>
                </div>
            </div>
            <form action="" method="POST">
                <input type="hidden" name="iduser" value="<?=$iduser?>">
            <button type="submit" name="checkout" onclick="return confirm('Apakah Anda yakin ingin checkout belanjaan sekarang?')">Checkout Belanjaan</button>
        </form>
    </center>
    </div>
</body>
</html>