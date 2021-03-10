<?php
session_start();
require 'Functions.php';
$idmitra = $_SESSION["iduser"];
$tanggal = $_GET["tanggal"];
if($tanggal==null){
    $query = "SELECT * FROM riwayat_user WHERE id_user='$idmitra'";
}else{
    $query = "SELECT * FROM riwayat_user WHERE id_user='$idmitra' AND tanggal='$tanggal'";
}

$result_tanggal = $conn->selectData($query);
echo json_encode($result_tanggal);


?>