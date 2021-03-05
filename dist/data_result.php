<?php
session_start();
require 'Functions.php';
if(!isset($_SESSION["iduser"])){
    header("location:index.php");
}

$keyword=$_GET["keyword"];

$query="";

if($_GET["keyword"]!=""){
    $keyword=$_GET["keyword"];
    $query="SELECT * FROM mitra,komoditi WHERE mitra.id=komoditi.id_mitra 
    AND nama_ikan LIKE '%$keyword%'";
}else if($keyword===""){
    $query="SELECT * FROM mitra";
}


$data = $conn->selectData($query);
echo json_encode($data);
?>