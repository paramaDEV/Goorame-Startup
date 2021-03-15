$(document).ready(()=>{
    $(".cancel").click(()=>{
        $(".updateAccountPanel").hide();
        $(".blackScreen").hide();
    });

    $(".hamburger").click(()=>{
        $(".sidebar").toggleClass("active");
        $(".hamburger").toggleClass("active2");
    });

    $(".btnGantiProfile").click(()=>{
        $(".gantiProfile").show();
        $(".blackScreen").css("display","flex");
    });

    $("#gambarProfile").change(()=>{
        let file=document.getElementById("gambarProfile").files;
        if(file.length>0){
            let fileReader = new FileReader();

            fileReader.onload = function (event){
                document.getElementById("tempProfile").setAttribute("src",event.target.result);
            }

            fileReader.readAsDataURL(file[0]);
        }
        
    });
});

let updateAccount = (id,nama,tanggal,kelamin,notelp,email,alamat,username)=>{
        $(".blackScreen").css("display","flex");
        $(".updateAccountPanel").show();
        $("#iduser").val(id);
        $("#nmlengkap").val(nama);
        $("#tanggal").val(tanggal);
        $("#kelamin").val(kelamin);
        $("#notelp").val(notelp);
        $("#email").val(email);
        $("#alamat").val(alamat);
        $("#username").val(username);
};
