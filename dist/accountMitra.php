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

if(isset($_POST["submit"])){
    $conn->updateMitra($_POST);
}

if(isset($_POST["submitGantiProfile"])){
    $conn->uploadProfileMitra($_POST);
}

if(isset($_POST["submitGantiSampul"])){
    $conn->uploadSampulMitra($_POST);
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
    <link rel="stylesheet" href="../css/accountMitra.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/accountMitra.js"></script>
    <title>Account</title>
</head>
<body>
<img src="../assets/blue-humberger.jpg" class="hamburger">
    <div class="sidebar">
        <center><img class="profile" src="../mitraimage/<?=$conn->cekGambar($data[0]['profile']);?>"  style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data[0]["nama_pemilik"]?></h4></center>
        <center><?php $conn->showStar($bintang)?></center>
        <div class="menu" >
            <a href="homeMitra.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="pesanan.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Pesanan <?=$conn->hitungPesanan($idmitra)?></h4></a>
            <a href="riwayatMitra.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="komoditi.php"><img src="../assets/komoditi.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Komoditi</h4></a>
            <a href=""><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
       <div class="kotak1">
           <div class="wrap">
           <center><img src="../mitraimage/<?=$conn->cekGambar($data[0]['profile']);?>" style="width:50%"></center>
           <center><h5 style="font-family:'Roboto',sans-serif;"><i>Rekomendasi : Upload foto minimal 250 x 250 pixel</i></h5></center>
           <center><button class="btnGantiProfile" style="margin-top:-10px;">Ganti Profil</button></center>
        </div>
           <br><br>
        <div class="wrap">
           <center><img src="../mitraimage/<?=$conn->cekGambar($data[0]['sampul']);?>" style="width:50%" ></center>
           <center><h5 style="font-family:'Roboto',sans-serif;"><i>Rekomendasi : Upload foto minimal 450 x 650 pixel</i></h5></center>
           <center><button class="btnGantiSampul" style="margin-top:-10px;margin-bottom:30px">Ganti Foto</button></center>
       </div></div>
       <div class="kotak2">
           <table style="width: 100%;">
                <tr>
                    <td><h3>Nama Usaha </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["nama_usaha"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Nama Lengkap </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["nama_pemilik"]?></h4></td>
                </tr>
               <tr>
                   <td><h3>Username </h3></td>
                   <td>:</td>
                   <td><h4><?=$data[0]["username"]?></h4></td>
               </tr>
                <tr>
                    <td><h3>Telepon </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["no_telepon"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Jam operasional </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["jam_operasional"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Email </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["email"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Alamat </h3></td>
                    <td>:</td>
                    <td><h4><?=$data[0]["alamat"]?></h4></td>
                </tr>
           </table>
          <button class="updateData"style="width: 100px;" onclick="updateAccount('<?=$idmitra?>','<?=$data[0]['nama_usaha']?>','<?=$data[0]['nama_pemilik']?>',
           '<?=$data[0]['username']?>','<?=$data[0]['no_telepon']?>','<?=$data[0]['jam_operasional']?>',
           '<?=$data[0]['email']?>','<?=$data[0]['alamat']?>');">Edit </button>
       </div>
       <div class="blackScreen">
            <div class="updateAccountPanel">
            <center><h1 style="">Form Edit Data</h1></center>
                <center>
                    <form action="" method="POST">
                    <table cellspacing="10">
                        <input id="idmitra" type="hidden" name="idmitra" value="<?=$idmitra?>">
                        <tr>
                            <td>Nama usaha : </td>
                            <td><input id="nmusaha" type="text" name="nmusaha"value="" ></td>
                        </tr>
                        <tr>
                            <td>Nama pemilik: </td>
                            <td><input id="nmpemilik" type="text" name="nmpemilik" value=""></td>
                        </tr>
                        <tr>
                            <td>Alamat: </td>
                            <td><textarea style="height:70px" id="alamat" type="text" name="alamat" value=""></textarea></td>
                        </tr>
                        <tr>
                            <td>Nomer telepon: </td>
                            <td><input id="notelp" type="text" name="notelp" value=""></td>
                        </tr>
                        <tr>
                            <td>Jam opersional: </td>
                            <td><input id="jam" type="text" name="jam" value=""></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input id="email" type="email" name="email" value=""></td>
                        </tr>
                        <tr>
                            <td>Username: </td>
                            <td><input id="username" type="text" name="username" value=""></td>
                        </tr>
                    </table>
                        <button type="submit" name="submit">Submit</button>
                        <button class="cancel">Cancel</button>
                    </form>
                </center>
            </div>
            <div class="gantiProfile">
                <center><h1>Ganti Foto Profil</h1></center>
                <center><img id="tempProfile" src="../mitraimage/noimage.png" height="200px"></center>
                <form action="" method="POST" enctype="multipart/form-data">
                        <center><input id="gambarProfile" type="file" name="gambar"></center>
                        <center><input type="hidden" name="idmitra" value=<?=$idmitra?>></center>
                        <br>
                       <center><button type="submit" name="submitGantiProfile">Submit</button>
                               <button class="cancel">Cancel</button></center>
                </form>
            </div>
            <div class="gantiSampul">
                <center><h1>Ganti Foto Sampul</h1></center>
                <center><img id="tempSampul" src="../mitraimage/noimage.png" height="200px"></center>
                <form action="" method="POST" enctype="multipart/form-data">
                        <center><input id="gambarSampul" type="file" name="gambar"></center>
                        <center><input type="hidden" name="idmitra" value=<?=$idmitra?>></center>
                        <br>
                       <center><button type="submit" name="submitGantiSampul">Submit</button>
                               <button class="cancel">Cancel</button></center>
                </form>
            </div>
       </div>
    </div>
</body>
</html>