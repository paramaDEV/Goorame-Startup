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

if(isset($_POST["submit"])){
    $conn->updateUser($_POST);
}

$iduser=$_SESSION["iduser"];
$data = $conn->selectData("SELECT * FROM user where id='$iduser';");

if(isset($_POST["submitGantiProfile"])){
    $conn->uploadProfileUser($_POST);
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
    <link rel="stylesheet" href="../css/accountUser.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/accountUser.js"></script>
    <title>Account</title>
</head>
<body>
    <div class="sidebar">
        <center><img class="profile" src="../userimage/<?=$conn->cekGambar($data[0]['profile']);?>" width="100px" height="100px" style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif">Lorem Ipsum</h4></center>
        <center><h5 class= "level" style="background-color:<?php echo $conn->cekLevel($data[0]["level"])?>"><?=$data[0]["level"]?></h5></center>
        <div class="menu" style="margin-top:100px;">
            <a href="homeUser.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="keranjang.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Keranjang <span style="margin-left:10px;background-color: red;padding:5px;border-radius:10px;">0</span></h4></a>
            <a href="riwayat.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href=""><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
       <div class="kotak1">
           <center><img src="../userimage/<?=$conn->cekGambar($data[0]['profile']);?>" height="200px"></center>
           <center><h5 style="font-family:'Roboto',sans-serif;"><i>Rekomendasi : Upload foto minimal 250 x 250 pixel</i></h5></center>
           <center><button class="btnGantiProfile" style="margin-top:-10px">Ganti Profil</button></center>
       </div>
       <div class="kotak2">
       <?php
       $no=1;
       foreach($data as $x):
       ?>
           <table style="width: 100%;">
               <tr>
                    <td><h3>Nama Lengkap </h3></td>
                    <td>:</td>
                    <td><h4><?=$x["nama"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Tanggal Lahir </h3></td>
                    <td>:</td>
                    <td><h4><?=$x["tanggal_lahir"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Jenis Kelamin</h3></td>
                    <td>:</td>
                    <td><h4><?=$x["kelamin"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Telepon </h3></td>
                    <td>:</td>
                    <td><h4><?=$x["no_telepon"]?></h4></td>
                </tr>
                <tr>
                    <td><h3>Email </h3></td>
                    <td>:</td>
                    <td><h4><?=$x["email"]?></h4></td>
                </tr>
               <tr>
                   <td><h3>Username </h3></td>
                   <td>:</td>
                   <td><h4><?=$x["username"]?></h4></td>
               </tr>
                <tr>
                    <td><h3>Alamat </h3></td>
                    <td>:</td>
                    <td><h4><?=$x["alamat"]?></h4></td>
                </tr>
                <?php
                $no++;
       endforeach;
                ?>
           </table>
           <td><button style="width: 100px;" onclick="updateAccount('<?=$iduser?>','<?=$x['nama']?>','<?=$x['tanggal_lahir']?>','<?=$x['kelamin']?>',
           '<?=$x['no_telepon']?>','<?=$x['email']?>','<?=$x['alamat']?>','<?=$x['username']?>');">Edit </button></td>
       </div>
    </div>
    <div class="blackScreen">
            <div class="updateAccountPanel">
            <center><h1 style="">Form Edit Data</h1></center>
                <center>
                    <form action="" method="POST">
                    <table cellspacing="10">
                        <input id="iduser" type="hidden" name="iduser" value="<?=$iduser?>">
                        <tr>
                            <td>Nama lengkap : </td>
                            <td><input id="nmlengkap" type="text" name="nmlengkap"value="" ></td>
                        </tr>
                        <tr>
                            <td>Tanggal lahir: </td>
                            <td><input id="tanggal" type="date" name="tanggal" value=""></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin </td>
                            <td><select id="kelamin" name="kelamin" required>
                                <option name="lk" value="Laki-laki">Laki-laki</option>
                                <option name="pr" value="Perempuan">Perempuan</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Nomer telepon: </td>
                            <td><input id="notelp" type="text" name="notelp" value=""></td>
                        </tr>
                        <tr>
                            <td>Email: </td>
                            <td><input id="email" type="email" name="email" value=""></td>
                        </tr>
                        <tr>
                            <td>Alamat: </td>
                            <td><textarea style="height:70px" id="alamat" type="text" name="alamat" value=""></textarea></td>
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
                        <center><input type="hidden" name="iduser" value=<?=$iduser?>></center>
                        <br>
                       <center><button type="submit" name="submitGantiProfile">Submit</button>
                               <button class="cancel">Cancel</button></center>
                </form>
            </div>
        </div>
</body>
</html>