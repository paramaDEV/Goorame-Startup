<?php
session_start();
require 'Functions.php';
require 'stats.php';

if(!isset($_SESSION["status"])){
    header("location:index.php");
    exit;
}else if($_SESSION["status"]!="mitra"){
    header("location:index.php");
    exit;
}
$idmitra=$_SESSION["idmitra"];
$this_date=date("Y-m-d");
$jumlah_ikan_terjual=0;

$data=$conn->selectData("SELECT * FROM mitra WHERE id='$idmitra'");
$data2=$conn->selectData("SELECT * FROM pesanan WHERE id_mitra='$idmitra' AND id_mitra='$idmitra'");
$data3=$conn->selectData("SELECT * FROM riwayat_mitra WHERE tanggal='$this_date' AND id_mitra='$idmitra'");

foreach($data3 as $x):
    $jumlah_ikan_terjual+=$x["jumlah"];
endforeach;

$bintang=$data[0]["bintang"];

for($i=0;$i<7;$i++){
    $arr_tanggal[]= $conn->hitungTanggal(-(1+$i));
    $arrdat[]=count($conn->selectData("SELECT * FROM riwayat_mitra WHERE id_mitra='$idmitra' AND tanggal='$arr_tanggal[$i]'"));
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
    <link rel="stylesheet" href="../css/homeMitra.css">
    <link rel="shortcut icon" href="../favicon.png">
    <title>Dashboard Mitra</title>
    <script src="../node_modules/chart.js/dist/Chart.js"></script>
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
        <center><img class="profile" src="../mitraimage/<?=$conn->cekGambar($data[0]['profile']);?>" style="margin-top: 20px;border-radius:50%;"></center>
        <center><h4 style="color:white;font-family:'Roboto',sans-serif"><?=$data[0]["nama_pemilik"]?></h4></center>
        <center><?php $conn->showStar($bintang)?></center>
        <div class="menu" >
            <a href=""><img src="../assets/home.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Beranda</h4></a>
            <a href="pesanan.php"><img src="../assets/keranjang.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Pesanan <span style="position:absolute;"><?=$conn->hitungPesanan($idmitra)?></span></h4></a>
            <a href="riwayatMitra.php"><img src="../assets/riwayat.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Riwayat</h4></a>
            <a href="komoditi.php"><img src="../assets/komoditi.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Komoditi</h4></a>
            <a href="accountMitra.php"><img src="../assets/account.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Akun</h4></a>
            <a href="logout.php"><img src="../assets/exit.png" height="25" style="float: left;margin: 10px;margin-top:5px;margin-right: 20px;"><h4>Logout</h4></a>
        </div>
    </div>
    <div class="content">
        <center><h1>Dashboard Mitra</h1></center>
        <center><div class="wrap-chart" style="width : 90%;">
            <canvas id="lineChart"  ></canvas>
        </div></center>
        <center>   
            <div class="wrap">
                <div class="kotak">
                    <div class="container" style="background-color: rgb(23, 89, 175);"><h1><?= count($data2);?></h1><h3>Pesanan aktif </h3></div>
                    <div class="container" style="background-color: rgb(218, 106, 15);" ><h1><?= count($data3);?></h1><h3>Pesanan selesai</h3></div>
                    <div class="container" style="background-color: rgb(218, 15, 66);"><h1><?= $jumlah_ikan_terjual;?></h1><h3>Kg ikan terjual </h3></div>
                </div>
            </div>
        </center>
    </div>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
    // Line chart
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:  ["<?= $datachart[0]["tanggal"]?>",
                        "<?= $datachart[1]["tanggal"]?>",
                        "<?= $datachart[2]["tanggal"]?>",
                        "<?= $datachart[3]["tanggal"]?>",
                        "<?= $datachart[4]["tanggal"]?>",
                        "<?= $datachart[5]["tanggal"]?>",
                        "<?= $datachart[6]["tanggal"]?>",
                    ],
            datasets: [{
                label: 'Data penjualan 7 hari terakhir',
                data: [<?= $datachart[0]["total"]?>,
                        <?= $datachart[1]["total"]?>,
                        <?= $datachart[2]["total"]?>,
                        <?= $datachart[3]["total"]?>,
                        <?= $datachart[4]["total"]?>,
                        <?= $datachart[5]["total"]?>,
                        <?= $datachart[6]["total"]?>,
                    ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
    scales: {
      xAxes: [{
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit:7
        }
      }],
      yAxes: [{
        ticks: {
          max: 20,
          maxTicksLimit: 5
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
    });

    </script>
</body>
</html>