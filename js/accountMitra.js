$(document).ready(()=>{
    $(".cancel").click(()=>{
        $(".updateAccountPanel").hide();
        $(".gantiProfile").hide();
        $(".gantiSampul").hide();
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
    $(".btnGantiSampul").click(()=>{
        $(".blackScreen").css("display","flex");
        $(".gantiSampul").show();
    });

    $("#gambarProfile").change(()=>{
        let file=document.getElementById("gambarProfile").files;
        if(file.length>0){
            let fileReader = new FileReader();

            fileReader.onload = function (event){
                document.getElementById("tempProfile").setAttribute("src",event.target.result);
            }

            fileReader.readAsDataURL(file[0]);
        }});

    
    $("#gambarSampul").change(()=>{
        let file=document.getElementById("gambarSampul").files;
        if(file.length>0){
            let fileReader = new FileReader();

            fileReader.onload = function (event){
                document.getElementById("tempSampul").setAttribute("src",event.target.result);
            }

            fileReader.readAsDataURL(file[0]);
        }});
 
});

let updateAccount = (id,nmusaha,nmpemilik,username,notelp,jam,email,alamat)=>{
    $(".blackScreen").css("display","flex");
    $(".updateAccountPanel").show();
    $("#idmitra").val(id);
    $("#nmusaha").val(nmusaha);
    $("#nmpemilik").val(nmpemilik);
    $("#alamat").val(alamat);
    $("#notelp").val(notelp);
    $("#jam").val(jam);
    $("#email").val(email);
    $("#username").val(username);
};

