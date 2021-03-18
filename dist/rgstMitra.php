<?php
require 'Functions.php';

if($conn->db->connect_error){
    die("error");
}

if(isset($_POST["submit"])){
    $conn->daftarMitra($_POST);
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
    <link rel="stylesheet" href="../css/rgstMitra.css">
    <title>Pendaftaran Mitra</title>
</head>
<body>
    <nav>
        <div class="logo" style="color:white">
        <h1><img src="../assets/logo hackton-03.png" style="margin-left:20px;"></h1>
        </div>
        <div class="home">
            <a href="../index.php"><h1 style="margin-right:20px;color:white;font-family:'Roboto',sans-serif;">Home</h1></a>
        </div>
    </nav>
    <center>
        <div class="registForm">
            <center><h1 style="font-family:'Roboto',sans-serif;color:rgb(37, 37, 37);">Form Registrasi Mitra</h1></center>
            <form action="" method="POST">
                <table border="0" cellspacing="30" style="position:relative;">
                    <tr>
                        <td>Nama Usaha</td>
                        <td><input type="text" name="nmusaha" placeholder="nama usaha" required></td>
                    </tr>
                    <tr>
                        <td>Nama Pemilik</td>
                        <td><input type="text" name="nmpemilik" placeholder="nama lengkap pemilik" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat" placeholder="alamat tempat usaha" required></textarea></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" placeholder="email" required></td>
                    </tr>
                    <tr>
                        <td>Nomer Telepon</td>
                        <td><input type="text" name="telepon" placeholder="nomer telepon" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Jam Operasional</td>
                        <td><input type="text" name="jam" placeholder="jam operasional" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" placeholder="username" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" placeholder="password" name="password"></td>
                    </tr>
                </table>
                <center><button type="submit" name="submit" style="width:40%">Daftar</button></center>
            </form>
        </div>
    </center>
</body>
</html>