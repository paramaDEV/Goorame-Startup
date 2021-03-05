<?php
require 'Functions.php';

if(!isset($_GET["id"])){
    header("location:komoditi.php");
    exit;
}

$conn->hapusIkan($_GET);
?>