<?php
session_start();
require 'Functions.php';
$idmitra = $_SESSION["idmitra"];
$tanggal = $_GET["tanggal"];
if($tanggal==null){
    $query = "SELECT * FROM riwayat_mitra WHERE id_mitra='$idmitra'";
}else{
    $query = "SELECT * FROM riwayat_mitra WHERE id_mitra='$idmitra' AND tanggal='$tanggal'";
}

$result_tanggal = $conn->selectData($query);
echo json_encode($result_tanggal);


?>