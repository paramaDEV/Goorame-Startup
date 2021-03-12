<?php
require_once("../phpmailer/PHPMailerAutoload.php");
date_default_timezone_set('Asia/Jakarta');
class Functions{
    public $db ;

    public function __construct($localhost,$username,$password,$dbname){
        $this->db=new mysqli($localhost,$username,$password,$dbname);
    }

    public function daftarUser($data){
        $nama = $data["nama"];
        $ttl  = $data["ttl"];
        $kelamin = $data["kelamin"];
        $telp = $data["telp"];
        $alamat = $data["alamat"];
        $email = $data["email"];
        $username = $data["username"];
        $password = password_hash($data["password"],PASSWORD_DEFAULT);

        $sql = "INSERT INTO user(nama,tanggal_lahir,tanggal_daftar,kelamin,no_telepon,
        email,alamat,username,password) values('$nama','$ttl',CURRENT_DATE(),'$kelamin',
        '$telp','$email','$alamat','$username','$password')";

        if($this->db->query($sql)==true){
            echo "<script>alert('Berhasil Daftar');</script>";
        }else{
            echo "".$this->db->error;
        }
    }

    public function daftarMitra($data){
        $nmusaha=$data["nmusaha"];
        $nmpemilik=$data["nmpemilik"];
        $alamat = $data["alamat"];
        $email=$data["email"];
        $telepon = $data["telepon"];
        $jam = $data["jam"];
        $username = $data["username"];
        $password = password_hash($data["password"],PASSWORD_DEFAULT);

        $sql= "INSERT INTO mitra (nama_pemilik,nama_usaha,alamat,no_telepon,
        jam_operasional,email,tanggal_daftar,username,password) 
        values ('$nmpemilik','$nmusaha','$alamat','$telepon','$jam','$email',CURRENT_DATE(),'$username','$password');";
    
        if($this->db->query($sql)==TRUE){
            echo "<script>alert('Berhasil daftar');</script>";
        }else{
            echo "".$this->db->error;
        }
    }

    public function login($data){
        $username = $data["username"];
        $password = $data["password"];

        $sql1 = "SELECT * FROM user WHERE username='$username'";
        $sql2 = "SELECT * FROM mitra WHERE username='$username'";

        $result1=$this->db->query($sql1);
        $result2=$this->db->query($sql2);

        if($result1->num_rows ===1){
            $row=$result1->fetch_assoc();
            if(password_verify($password,$row["password"])){
                $_SESSION["iduser"]=$row["id"];
                $_SESSION["status"]="user";
                echo "<script>alert('Anda berhasil login');window.location.href='homeUser.php';</script>";
            }else{
                echo "<script>alert('Silahkan periksa kembali username dan password anda');</script>";
            }
        }else if($result2->num_rows ===1){
            $row = $result2->fetch_assoc();
            if(password_verify($password,$row["password"])){
                $_SESSION["idmitra"]=$row["id"];
                $_SESSION["status"]="mitra";
                echo "<script>alert('Anda berhasil login');window.location.href='homeMitra.php';</script>";
            }else{
                echo "<script>alert('Silahkan periksa kembali username dan password anda');</script>";
            }
        }else{
            echo "<script>alert('Silahkan periksa kembali username dan password anda');</script>";
        }
    }

    public function updateMitra($data){
        $id=$data["idmitra"];
        $nmusaha=$data["nmusaha"];
        $nmpemilik=$data["nmpemilik"];
        $alamat=$data["alamat"];
        $notelp=$data["notelp"];
        $jam=$data["jam"];
        $email=$data["email"];
        $username=$data["username"];

        $query="UPDATE mitra set nama_usaha='$nmusaha', nama_pemilik='$nmpemilik', alamat='$alamat',
        no_telepon='$notelp',jam_operasional='$jam',email='$email',username='$username' WHERE id='$id';";

        if($this->db->query($query)==TRUE){
            echo "<script>alert('Berhasil Update');</script>";
        }else{
            echo "".$this->db->error;
        }
    }

    public function selectData($query){
        $result = $this->db->query($query);
        $data = [];
        if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
                $data[] = $row;
            }
        }
        return $data;
    }

    public function rupiah($angka){
        $hasil = number_format($angka,0,",",".");
        return $hasil;
    }

    public function updateIkan($data){
        $id=$data["idikan"];
        $idmitra=$data["idmitra"];
        $nmikan=$data["nmikan"];
        $stok=$data["stok"];
        $status=$data["status"];
        $harga=$data["harga"];

        $query="UPDATE komoditi SET nama_ikan='$nmikan',stok='$stok',status='$status',harga='$harga' WHERE id='$id' AND id_mitra='$idmitra';";


        if($this->db->query($query)==TRUE){
            echo "<script>alert('Berhasil Update');</script>";
        }else{
            echo "".$this->db->error;
        }
    }  

    public function updateUser($data){
        $id=$data["iduser"];
        $nama=$data["nmlengkap"];
        $tanggal=$data["tanggal"];
        $kelamin=$data["kelamin"];
        $notelp=$data["notelp"];
        $email=$data["email"];
        $alamat=$data["alamat"];
        $username=$data["username"];

        $query="UPDATE user SET nama='$nama',tanggal_lahir='$tanggal',kelamin='$kelamin',no_telepon='$notelp', email='$email', alamat='$alamat', username='$username' WHERE id='$id' ;";


        if($this->db->query($query)==TRUE){
            echo "<script>alert('Berhasil Update');</script>";
        }else{
            echo "".$this->db->error;
        }
    } 

    public function hapusIkan($data){
        $idikan=$data["id"];
        $idmitra=$data["id_mitra"];

        $sql = "DELETE FROM komoditi WHERE id='$idikan' AND id_mitra='$idmitra'";
        if($this->db->query($sql)==TRUE){
            echo "<script>alert('Berhasil Hapus');document.location.href='komoditi.php'</script>";
        }else{
            echo "".$this->db->error;
        }
    }

    public function uploadProfileMitra($data){
        $idmitra=$data["idmitra"];
        $namafile=$_FILES["gambar"]["name"];
        $ukuranfile=$_FILES["gambar"]["size"];
        $error=$_FILES["gambar"]["error"];
        $tmp=$_FILES["gambar"]["tmp_name"];

        
        if($error === 4){
            echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
            return false;
        }

        $extensionAllowed=['jpg','png','jpeg'];
        $extension = explode(".",$namafile);
        $extension = strtolower(end($extension));

        if(!in_array($extension,$extensionAllowed)){
            echo "<script>alert('Ekstensi yang diperbolehkan adalah jpg, png, jpeg');</script>";
            return false;
        }

        if($ukuranfile > 1000000){
            echo "<script>alert('Ukuran yang diperbolehkan maksimal 1 MB');</script>";
            return false;
        }

        $namafilebaru="".uniqid()."."."$extension";
        move_uploaded_file($tmp,"../mitraimage/$namafilebaru");

        $query = "UPDATE mitra SET profile='$namafilebaru' WHERE id='$idmitra';";
        if($this->db->query($query) === false){
            echo $this->db->error;
        };
        
        echo "<script>alert('Gambar berhasil di update');window.location.href='accountMitra.php'</script>";
    }

    public function uploadProfileUser($data){
        $iduser=$data["iduser"];
        $namafile=$_FILES["gambar"]["name"];
        $ukuranfile=$_FILES["gambar"]["size"];
        $error=$_FILES["gambar"]["error"];
        $tmp=$_FILES["gambar"]["tmp_name"];

        
        if($error === 4){
            echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
            return false;
        }

        $extensionAllowed=['jpg','png','jpeg'];
        $extension = explode(".",$namafile);
        $extension = strtolower(end($extension));

        if(!in_array($extension,$extensionAllowed)){
            echo "<script>alert('Ekstensi yang diperbolehkan adalah jpg, png, jpeg');</script>";
            return false;
        }

        if($ukuranfile > 1000000){
            echo "<script>alert('Ukuran yang diperbolehkan maksimal 1 MB');</script>";
            return false;
        }

        $namafilebaru="".uniqid()."."."$extension";
        move_uploaded_file($tmp,"../userimage/$namafilebaru");

        $query = "UPDATE user SET profile='$namafilebaru' WHERE id='$iduser';";
        if($this->db->query($query) === false){
            echo $this->db->error;
        };
        
        echo "<script>alert('Gambar berhasil di update');window.location.href='accountUser.php'</script>";

    }

    public function uploadSampulMitra($data){
        $idmitra=$data["idmitra"];
        $namafile=$_FILES["gambar"]["name"];
        $ukuranfile=$_FILES["gambar"]["size"];
        $error=$_FILES["gambar"]["error"];
        $tmp=$_FILES["gambar"]["tmp_name"];

        
        if($error === 4){
            echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
            return false;
        }

        $extensionAllowed=['jpg','png','jpeg'];
        $extension = explode(".",$namafile);
        $extension = strtolower(end($extension));

        if(!in_array($extension,$extensionAllowed)){
            echo "<script>alert('Ekstensi yang diperbolehkan adalah jpg, png, jpeg');</script>";
            return false;
        }

        if($ukuranfile > 1000000){
            echo "<script>alert('Ukuran yang diperbolehkan maksimal 1 MB');</script>";
            return false;
        }

        $namafilebaru="".uniqid()."."."$extension";
        move_uploaded_file($tmp,"../mitraimage/$namafilebaru");

        $query = "UPDATE mitra SET sampul='$namafilebaru' WHERE id='$idmitra';";
        if($this->db->query($query) === false){
            echo $this->db->error;
        };
        
        echo "<script>alert('Gambar berhasil di update');window.location.href='accountMitra.php'</script>";
    }

    public function uploadGambarKomoditi($data){
        $idmitra=$data["idmitra"];
        $nmikan=$data["nmikan"];
        $stok=$data["stok"];
        $status=$data["status"];
        $harga=$data["harga"];

        $namafile=$_FILES["gambar"]["name"];
        $ukuranfile=$_FILES["gambar"]["size"];
        $error=$_FILES["gambar"]["error"];
        $tmp=$_FILES["gambar"]["tmp_name"];

        
        if($error === 4){
            echo "<script>alert('Pilih gambar terlebih dahulu')</script>";
            return false;
        }

        $extensionAllowed=['jpg','png','jpeg'];
        $extension = explode(".",$namafile);
        $extension = strtolower(end($extension));

        if(!in_array($extension,$extensionAllowed)){
            echo "<script>alert('Ekstensi yang diperbolehkan adalah jpg, png, jpeg');</script>";
            return false;
        }

        if($ukuranfile > 1000000){
            echo "<script>alert('Ukuran yang diperbolehkan maksimal 1 MB');</script>";
            return false;
        }

        $namafilebaru="".uniqid()."."."$extension";
        move_uploaded_file($tmp,"../mitraimage/$namafilebaru");

        $query = "INSERT INTO komoditi(id_mitra,nama_ikan,status,stok,harga,gambar)values('$idmitra','$nmikan','$status','$stok','$harga','$namafilebaru');";
        if($this->db->query($query) === false){
            echo $this->db->error;
        };
        
        echo "<script>alert('Berhasil menambahkan data');window.location.href='komoditi.php'</script>";
    }
    public function cekGambar($image){
        if($image==null){
            return "noimage.png";
        }else{
            return "$image";
        }
    }

    public function showStar($jumlah){
        for($i=0;$i<$jumlah;$i++){
            echo "<img src='../assets/star.png' height='20px' style='margin-top:-15px;margin-bottom:-15px'>";
        }
    }

    public function cekLevel($data){
        if($data==="Bronze"){
            return "rgb(235, 124, 73)";
        }else if($data==="Silver"){
            return "rgb(189, 189, 189)";
        }else if($data==="Gold"){
            return "rgb(219, 152, 7)";
        }
    }

    public function tambahKeranjang($data){
        $iduser=$data["iduser"];
        $idmitra=$data["idmitra"];
        $nmikan=$data["nmikan"];
        $jumlah=$data["jumlah"];
        $harga=$data["harga"];
        $biaya=$jumlah*$harga;

        $query="INSERT INTO keranjang(id_user,id_mitra,ikan,jumlah,biaya) VALUES ('$iduser','$idmitra','$nmikan','$jumlah','$biaya')";

        if($this->db->query($query)==true){
            echo "<script>alert('Berhasil menambahkan item ke keranjang');window.location.href='keranjang.php'</script>";
        }else{
            echo $this->db->error;
            exit;
        }
    }

    public function checkout($data){
        $iduser=$data["iduser"];
        $data1 = $this->selectData("SELECT * FROM keranjang WHERE id_user='$iduser'");
        $data2 = $this->selectData("SELECT * FROM user WHERE id='$iduser'");
        foreach($data1 as $x):
            $idmitra=$x["id_mitra"];
            $datamitra=$this->selectData("SELECT * FROM mitra WHERE id='$idmitra'");
            $ikan=$x["ikan"];
            $email=$datamitra[0]["email"];
            $jumlah=$x["jumlah"];
            $biaya=$x["biaya"];
            $query="INSERT INTO pesanan (id_user,id_mitra,ikan,jumlah,biaya) values ('$iduser','$idmitra','$ikan','$jumlah','$biaya')";
            $query2="INSERT INTO riwayat_user (id_user,tanggal,item,jumlah,harga) values ('$iduser',CURRENT_DATE,'$ikan','$jumlah','$biaya')";
            $this->db->query($query);
            $this->db->query($query2);
            $this->kirimEmailKeMitra($email,$ikan,$jumlah,$biaya);
            $this->kirimEmailKeUser($data2[0]["email"]);
        endforeach;

            $query2="DELETE FROM keranjang WHERE id_user='$iduser'";
            if($this->db->query($query2)==true){
                echo "<script>alert('Belanjaan berhasil di checkout !!!')</script>";
            }
    }

    public function akhiriPesanan($data){
        $idmitra = $data["idmitra"];
        $data = $this->selectData("SELECT * FROM pesanan WHERE id_mitra='$idmitra'");
        foreach($data as $x):
            $ikan=$x["ikan"];
            $jumlah=$x["jumlah"];
            $harga=$x["biaya"];

            $query = "INSERT INTO riwayat_mitra(id_mitra,tanggal,item,jumlah,harga) values ('$idmitra',CURRENT_DATE,'$ikan','$jumlah','$harga')";
            if($this->db->query($query)==false){
                echo $this->db->error;
            }
        endforeach;
        $this->db->query("DELETE FROM pesanan WHERE id_mitra='$idmitra'");
        echo "<script>alert('Berhasil');window.location.href='pesanan.php'</script>";
    }

    public function hitungKeranjang($id){
        $data = $this->selectData("SELECT * FROM keranjang WHERE id_user='$id'"); 
        $jumlah = count($data);
        if($jumlah>0){
            return "<span style='margin-left:10px;background-color: red;padding:5px;border-radius:10px;'>$jumlah</span>";
            exit;
        }else{
            return "";
        }
    }

    public function hitungPesanan($id){
        $data = $this->selectData("SELECT * FROM pesanan WHERE id_mitra='$id'"); 
        $jumlah = count($data);
        if($jumlah>0){
            return "<span style='margin-left:10px;background-color: red;padding:5px;border-radius:10px;'>$jumlah</span>";
            exit;
        }
    }

    public function hitungTanggal($nomer=0){
         return date("Y-m-d",time()+(60*60*24*$nomer));
    }

    public function kirimEmailKeMitra($emailmitra,$namaIkan,$jumlah,$harga){
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth=true;
        $mail->SMTPSecure = "tls";
        $mail->Host="smtp.gmail.com";
        $mail->Port=587;
        $mail->isHTML();
        $mail->Username="";
        $mail->Password="";
        $mail->setFrom("".$emailmitra);
        $mail->Subject="Pesanan Baru";
        $mail->Body="<b><h1>Anda mendapatkan pesanan baru.</h1></b>
                    <br>
                    Seseorang membeli ikan dengan rincian sebagai berikut:<br>
                    Item : $namaIkan<br>
                    Jumlah : $jumlah<br>
                    Harga : $harga / Kilogram<br>
                    Silahkan proses pesanan, kurir akan mengambilnya dalam beberapa menit.
                    ";
        $mail->AddAddress("");

        if(!$mail->Send()){
            echo "Error : ".$mail->ErrorInfo;
        }
            }
        
            public function kirimEmailKeUser($email){
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth=true;
                $mail->SMTPSecure = "tls";
                $mail->Host="smtp.gmail.com";
                $mail->Port=587;
                $mail->isHTML();
                $mail->Username="";
                $mail->Password="";
                $mail->setFrom("".$email);
                $mail->Subject="Checkout";
                $mail->Body="<b><h1>Pesanan anda sedang di proses.</h1></b>
                            Mohon tunggu beberapa saat. Kurir akan mengirimkan pesanan Anda dengan segera.
                            <br>
                            Balas email ini jika terdapat pertanyaan.
                            ";
                $mail->AddAddress("");
        
                if(!$mail->Send()){
                    echo "Error : ".$mail->ErrorInfo;
                }
                    }
}


$conn = new Functions("localhost","root","","lomba_hackathon");

?>