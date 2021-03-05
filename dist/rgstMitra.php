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
    <link rel="stylesheet" href="../css/rgstUser.css">
    <title>Pendaftaran Mitra</title>
</head>
<body>
    <nav>
        <div class="logo" style="color:white">
        <h1><img src="../assets/logo hackton-03.png" height="80px" style="margin-left:20px;"></h1>
        </div>
        <div class="">
            <a href="../index.php"><h1 style="margin-right:20px;color:white;font-family:'Roboto',sans-serif;">Home</h1></a>
        </div>
    </nav>
    <center>
        <div class="registForm">
            <center><h1 style="font-family:'Roboto',sans-serif;color:rgb(37, 37, 37)">Form Registrasi Mitra</h1></center>
            <form action="" method="POST">
                <table border="0" cellspacing="30" style="position:relative;">
                    <tr>
                        <td>Nama Usaha</td>
                        <td><input type="text" name="nmusaha" required></td>
                    </tr>
                    <tr>
                        <td>Nama Pemilik</td>
                        <td><input type="text" name="nmpemilik" required></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat" required></textarea></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Nomer Telepon</td>
                        <td><input type="text" name="telepon" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Jam Operasional</td>
                        <td><input type="text" name="jam" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input type="text" name="username" required autocomplete="off"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" style="height: 15px;" required></td>
                        <td><span style="float: left;display: inline;font-family: 'Raleway',sans-serif;font-size: 15px;">Saya menerima segala ketentuan dan kebijakan</span></td>
                    </tr>
                </table>
                <button type="submit" name="submit">Daftar</button>
            </form>
        </div>
    </center>
</body>
</html>