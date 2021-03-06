<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300&family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="shortcut icon" href="favicon.png">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script >
        $(document).ready(()=>{
            $(".hamburger").click(()=>{
                $("nav ul").toggleClass("active");
            })
        });
    </script>
    <title>Welcome to GooraMe</title>
</head>
<script>
    // alert(`Perhatian !! Web ini bukan untuk komersil, melainkan untuk kompetisi. 
    // Jika terjadi sesuatu itu bukan tanggung jawab kami. Terima kasih.`);
</script>
<body>
    <nav>
         <div class="logo" >
             <img src="./assets/logo hackton-03.png">
         </div>
         <div class="navlinks">
             <ul class="">
                 <li><a href="#landing">Beranda</a></li>
                 <li><a href="#tentang">Tentang</a></li>
                 <li><a href="#layanan">Layanan</a></li>
                 <li><a href="#kontak">Kontak</a></li>
                 <li><a href="./dist/index.php">Masuk</a></li>
             </ul>
         </div>   
         <img src="assets/hamburger.png" height="22px" class="hamburger">
    </nav>
    <section class="sectionA" id="landing">
        <div class="textBox" >
            <h1>BELI IKAN</h1>
            <h1>JADI LEBIH MUDAH</h1>
            <h3>Menjual berbagai macam ikan untuk kebutuhan anda</h3>
            <h3>Anda cukup dirumah, kami yang mengantarkan</h3>
            <a href="./dist/index.php"><button class="btn" >Belanja Sekarang</button></a>
        </div>
        <div class="imgBox"   >
            <center><img src="./assets/landing.png" height="720px"></center>
        </div>
    </section>
    <section class="sectionB" id="tentang">
        <center><h1>Tentang Kami</h1></center>
        <center><p style="width:30%;line-height:30px;"><h3 >GooraMe merupakan website penyedia jasa layanan bagi kita yang ingin membeli ikan
            tapi malas untuk keluar rumah, apalagi dalam kondisi pandemi seperti sekarang. Kami hadir
            menawarkan solusi untuk anda . Kurir kami akan membeli dan mengantarkannya sampai rumah anda.
            Bekerja sama dengan puluhan pemilik budidaya lokal dengan berbagai jenis pilihan ikan. Pelayanan
            dan kualitas menjadi prioritas kami. Karena kepuasan customer adalah kepuasan kami juga.
        </h3></p></center>
    </section>
    <section class="sectionC" id="layanan">
        <center><h1 >Layanan</h1></center>
        <div class="wrap" style="margin-top: 20px;">
            <div class="box" >
                <img src="./assets/diantar.png" >
                <center><h3>Pesanan dikirim langsung ke rumah anda</h3></center>
            </div>
            <div class="box" >
                <img src="./assets/kualitas.png" >
                <center><h3>Kualitas ikan sangat baik dan terjamin</h3></center>
            </div>
            <div class="box" >
                <img src="./assets/terjangkau.png" >
                <center><h3>Biaya terjangkau</h3></center>
            </div>
            <div class="box" >
                <img src="./assets/kapansaja.png" >
                <center><h3>Bisa pesan kapan saja</h3></center>
            </div>
        </div>
    </section>
    <section class="sectionD">
        <center><h1 >Mitra</h1></center>
        <div class="wrap">
            <div class="box">
                <img src="./assets/seller1.jpg" >
                <div>
                    <h1>Bapak Amirullah</h1>
                    <p>"Setelah bergabung dengan start up GooraMe, allhamdulillah
                        penjualan ikan saya meningkat".
                    </p>
                </div>
            </div>
            <div class="box">
                <img src="./assets/seller2.jpg" >
                <div>
                    <h1>Bapak Husain</h1>
                    <p>"GooraMe sangat bagus, mereka memajukan perekonomian
                        pengusaha budidaya ikan lokal. Pendapatan saya juga
                        bertambah".</p>
                </div>
            </div>
            <div class="box">
                <img src="./assets/seller3.jpg" >
                <div>
                    <h1>Bapak Rusdi</h1>
                    <p>"Saya senang bergabung dengan GooraMe ini. allhamdulillah
                        usaha saya semakin maju. Sekarang malah mau membuka kolam
                        baru".</p>
                </div>
            </div>
            <div class="box">
                <img src="./assets/seller4.jpg" >
                <div>
                    <h1>Mas Fauzan</h1>
                    <p>"Dulu saya ragu mau memulai bisnis perikanan. Setelah
                        diberi pelatihan oleh GooraMe, sekarang saya sudah memiliki omset
                        sampai 15 juta perbulan".</p>
                </div>
            </div>
            <div class="box">
                <img src="./assets/seller5.jpg" >
                <div>
                    <h1>Bapak Nasruddin</h1>
                    <p>"Awal saya membangun usaha budidaya lele, usaha saya
                        sangat sepi. Sempat berpikir mau pindah haluan. Setelah 
                        menjadi mitra GooraMe, usaha saya semakin maju".</p>
                </div>
            </div>
            <div class="box">
                <img src="./assets/seller6.jpg" >
                <div>
                    <h1>Mas Ujang</h1>
                    <p>"Pokoknya GooraMe joss dah, petani ikan
                        pemula seperti saya merasa terbantu sekali".</p>
                </div>
            </div>
        </div>
        <center><a href="./dist/rgstMitra.php"><button class="btn" style="margin-top:80px;">Daftar Mitra</button></a></center>
    </section>
    <section class="sectionE" id="kontak">
        <center><h1>Contact</h1></center>
            <center><div class="telp">
                <h3 style="font-family:'Assistant', sans-serif;">Fany Parama Admaja    : 083144290139</h3>
                <h3 style="font-family:'Assistant', sans-serif;">Seta Murdha Pamungkas : 081312867218</h3>
                <h3 style="font-family:'Assistant', sans-serif;">Mauren Helvia Devi    : 081333406278</h3>
            </div></center>
            <center><h1 style="font-family:'Assistant';margin-top: 30px;">Made with spirit by Taksaka Team</h1></center>
            <center><img src="./assets/taksaka.png" ></center>    
    </section>
    
</body>
</html>