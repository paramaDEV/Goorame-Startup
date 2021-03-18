<?php
session_start();
require 'Functions.php';

if(isset($_SESSION["status"])){
    if($_SESSION["status"]=="user"){
        header("location:homeUser.php");
        exit;   
    }else if($_SESSION["status"]=="mitra"){
        header("location:homeMitra.php");
        exit;   
    }
}

if(isset($_POST["submit"])){
    $conn->login($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../favicon.png">
    <link rel="stylesheet" href="../css/rgstUser.css">
    <title>Halaman login</title>
</head>
<body>
    <nav>
        <div class="logo" style="color:white">
            <h1><img src="../assets/logo hackton-03.png"  style="margin-left:20px;"></h1>
        </div>
        <div class="home">
            <a href="../index.php"><h1 style="margin-right:20px;color:white;font-family:'Roboto',sans-serif;">Home</h1></a>
        </div>
    </nav>
    <center>
        <div class="registForm">
            <center><h1 style="font-family:'Roboto',sans-serif;color:rgb(37, 37, 37);">Login</h1></center>
            <form action="" method="POST">
                <table border="0" cellspacing="30" style="position:relative;">
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username"  placeholder="Username" autocomplete=off required></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" placeholder="Password" name="password"></td>
                    </tr>
                </table>
                <center><button type="submit" name="submit" style="width:40%">Masuk</button></center>
                <h4 style="font-family: 'Raleway',sans-serif;">Belum punya akun? <a href=rgstUser.php>daftar akun</a></h4>
            </form>
        </div>
    </center>
</body>
</html>