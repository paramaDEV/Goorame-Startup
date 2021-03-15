$(document).ready(()=>{
    $(".hamburger").click(()=>{
        $(".sidebar").toggleClass("active");
        $(".hamburger").toggleClass("active2");
    })

    $("#searchField").keyup(()=>{
        let iduser=$("#iduser").val();
        let keyword=$("#searchField").val();
        console.log(keyword);
        let xhr =new XMLHttpRequest();
        

        xhr.onreadystatechange=()=>{
            if(xhr.readyState==4 && xhr.status==200){
               let data = JSON.parse(xhr.responseText);
               console.log(data);
               let result = document.getElementsByClassName("result")[0];
               result.innerHTML="";
               data.forEach(e => {
                   let {id_mitra,sampul,nama_usaha,alamat,bintang,jam_operasional}=e;
                   renderCard(iduser,id_mitra,sampul,nama_usaha,alamat,bintang,jam_operasional);
               });
            }
        }

        xhr.open('GET',`http://localhost/hackathon/dist/data_result.php?keyword=${keyword}`,true);
        xhr.send();
    });

    let countStars = (e) =>{
        let text="";
        for(let i=0;i<e;i++){
            text+="<img src='../assets/star.png' height='20px' style='margin-top:-15px;margin-bottom:-15px'>";
        }

        return text;
    };
    let renderCard = (id,idmitra,sampul,namausaha,alamat,bintang,jam)=>{
        let result = document.getElementsByClassName("result")[0];
        result.innerHTML+=` <div class="kotak">
        <div class="gambar">
            <img src="../mitraimage/${sampul}" height="200px">
        </div>
        <center><h4 style="color: rgb(22, 22, 22);">${namausaha}</h4></center>
        <h5 style="font-family: 'Open Sans',sans-serif;line-height:18px;margin-bottom:2px">${alamat}</h5>
        <center>${countStars(bintang)}</center>
        <h5 style="font-family: 'Open Sans',sans-serif;">Jam Operasional : ${jam}</h5>
        <center><a href="lapak.php?idmitra=${idmitra}&iduser=${id}"><button>Kunjungi Lapak</button></a></center></div>`
    }
});