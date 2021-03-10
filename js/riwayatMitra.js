$(document).ready(()=>{
    let xhr = new XMLHttpRequest();
    let row = "";
    let blank = "";

    
    $('#alltanggal').click(()=>{
        xhr.onreadystatechange=()=>{
            if(xhr.readyState==4 && xhr.status==200){
                let data = JSON.parse(xhr.responseText);
                
                 data.forEach(e=>{
                    row+=generateRow(e.tanggal,e.item,e.jumlah,e.harga);
                    console.log("ok");
                    
                });
                generateTable(row);
                row="";
            }
        }

        xhr.open('GET',`http://localhost/hackathon/dist/data_riwayat_mitra.php?tanggal`,true);
        xhr.send();
    });

    $("#tanggal").change(()=>{
        let tanggal = $("#tanggal").val();
        xhr.onreadystatechange=()=>{
            if(xhr.readyState==4 && xhr.status==200){
                let data = JSON.parse(xhr.responseText);
                 data.forEach(e=>{
                    row+=generateRow(e.tanggal,e.item,e.jumlah,e.harga);
                    console.log("ok");
                    
                });
                
                generateTable(row);
                row="";
                
            }
        }

        xhr.open('GET',`http://localhost/hackathon/dist/data_riwayat_mitra.php?tanggal=${tanggal}`,true);
        xhr.send();
       
    });

    let generateTable = (data)=>{
        let table = document.querySelector("table");
        let thead = ` <tr>
                        <td>Tanggal</td>
                        <td>Item</td>
                        <td>Jumlah</td>
                        <td>Hasil</td>
                    </tr>`;
        table.innerHTML=`
                        ${thead}
                        ${data}
                    `;
    }

    let generateRow = (tanggal,item,jumlah,hasil)=>{
       return `<tr>
                <td>${tanggal}</td>
                <td>${item}</td>
                <td>${jumlah}</td>
                <td>${hasil}</td>
              </tr>`;
    }
});


