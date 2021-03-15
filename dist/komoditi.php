<?php
session_start();
require 'Functions.php';

if(isset($_POST["submit"])){
    $conn->updateIkan($_POST);
}

if(!isset($_SESSION["status"])){
    header("location:index.php");
    exit;
}else if($_SESSION["status"]!="mitra"){
    header("location:index.php");
    exit;
}

$idmitra=$_SESSION["idmitra"];
$data = $conn->selectData("SELECT * FROM komoditi WHERE id_mitra='$idmitra'");
$data2=$conn->selectData("SELECT * FROM mitra WHERE id='$idmitra'");
$bintang=$data2[0]["bintang"];

if(isset($_POST["tambah"])){
    $conn->uploadGambarKomoditi($_POST);
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
    <link rel="stylesheet" href="../css/komoditi.css"><link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/komoditi.js"></script>
    <title>Komoditi</title>
</head>
<body> 
<img src="../assets/blue-humberger.jpg" class="hamburger">
    <div class="sidebar"> 
        <center><img class="profile" src="../mitraimage/<?=$conn->cekGambar($data2[0]['profile']);?>"  style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data2[0]["nama_pemilik"]?></h4></center>
        <center><?php $conn->showStar($bintang)?></center>
        <div class="menu" style="margin-top:100px;">
            <a href="homeMitra.php"><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="pesanan.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Pesanan <span style="position:absolute;"><?=$conn->hitungPesanan($idmitra)?></h4></a>
            <a href="riwayatMitra.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href=""><img src="../assets/komoditi.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Komoditi</h4></a>
            <a href="accountMitra.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <center><h1 style="margin-top:50px">Komoditi</h1></center>
        <center>
            <div class="wrap">
            <?php
            $no = 1;
            foreach($data as $x):
            ?>
                <div class="item">
                    <center><img src="../mitraimage/<?=$conn->cekGambar($x['gambar']);?>"></center>
                    <center><h2><?=$x["nama_ikan"];?></h2></center>
                    <center><h3>Stok : <?= $x["stok"];?> Kg</h3></center>
                    <center><h3>Harga : Rp. <?= $conn->rupiah($x["harga"]);?> / Kg</h3></center>
                    <center>
                        <button class="btnEdit" name="btnEdit" onclick="editData(<?=$x['id']?>,<?=$x['id_mitra']?>,'<?=$x['nama_ikan']?>','<?=$x['stok']?>','<?=$x['harga']?>');"><img src="../assets/edit.png" style="height:20px"></button>
                        <a href="hapus.php?id=<?=$x['id']?>&id_mitra=<?=$x['id_mitra']?>" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><button style="background-color: rgb(177, 16, 16);" ><img src="../assets/deleter.png" style="height:20px"></button></a>
                    </center>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="itemAdd">
                    <button class="add"><img src="../assets/add.png"></button>
                </div>
        </center>
        <div class="blackScreen">
            <div class="panelEdit">
                <center><h1>Form Edit Data</h1></center>
                <center>
                    <form action="" method="POST">
                    <table cellspacing="10">
                        <input id="idikan" type="hidden" name="idikan" value="">
                        <input id="idmitra" type="hidden" name="idmitra" value="">
                        <tr>
                            <td>Nama Ikan : </td>
                            <td><input id="nmikan" type="text" name="nmikan"value="" ></td>
                        </tr>
                        <tr>
                            <td>Stok : </td>
                            <td><input id="stok" type="text" name="stok" value=""></td>
                        </tr>
                        <tr>
                            <td>Status : </td>
                            <td><select id="status" name="status">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Sedang tidak tersedia">Tidak tersedia</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Harga: </td>
                            <td><input id="harga" type="text" name="harga" value=""></td>
                        </tr>
                    </table>
                        <button type="submit" name="submit">Submit</button>
                        <button class="cancel">Cancel</button>
                    </form>
                </center>
            </div>
            <div class="panelTambah">
                <center><h1>Form  Tambah Data</h1></center>
                <center>
                    <form action="" method="POST" enctype="multipart/form-data">
                    <table cellspacing="10">
                        <input id="idmitra" type="hidden" name="idmitra" value="<?=$idmitra?> ">
                        <tr>
                            <td>Nama Ikan : </td>
                            <td><input id="nmikan" type="text" name="nmikan"value="" ></td>
                        </tr>
                        <tr>
                            <td>Stok : </td>
                            <td><input id="stok" type="text" name="stok" value=""></td>
                        </tr>
                        <tr>
                            <td>Status : </td>
                            <td><select id="status" name="status">
                                <option value="Tersedia">Tersedia</option>
                                <option value="Sedang tidak tersedia">Tidak tersedia</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td>Harga: </td>
                            <td><input id="harga" type="text" name="harga" value="">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2><span style="font-size:14px"><i>Penghasilan yang diperoleh di setiap penjualan akan dikurangi 10% 
                            untuk dibagikan kepada start-up, sesuai persyaratan & persetujuan.</span></i></td>
                        </tr>
                        <tr>
                            <td>Gambar: </td>
                            <td><input id="gambar" type="file" name="gambar" value="" style="background-color:unset"></td>
                        </tr>
                    </table>
                        <button type="submit" name="tambah">Submit</button>
                        <button class="cancel">Cancel</button>
                    </form>
                </center>
            </div>

        </div>
    </div>      
</body>
</html>