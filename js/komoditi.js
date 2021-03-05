const editData = (id,id_mitra,nama,stok,harga)=>{
    $(".blackScreen").css("display","flex");
    $(".panelEdit").show();
    $("#idikan").val(id);
    $("#idmitra").val(id_mitra);
    $("#nmikan").val(nama);
    $("#stok").val(stok);
    $("#harga").val(harga);
    console.log(id,id_mitra,nama,stok,harga);
};

$(document).ready(()=>{
    $(".cancel").click(()=>{
        $(".blackScreen").hide();
    });

    $(".add").click(()=>{
        $(".blackScreen").css("display","flex");
        $(".panelTambah").show();
    });

});