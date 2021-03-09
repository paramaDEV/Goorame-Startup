<?php



$idmitra=$_SESSION["idmitra"];

// echo $conn->hitungTanggal();
$arr_tanggal=[];
$arrdat=[];

for($i=0;$i<7;$i++){
    $arr_tanggal[]= $conn->hitungTanggal(-(1+$i));
    $arrdat[]=count($conn->selectData("SELECT * FROM riwayat_mitra WHERE id_mitra='$idmitra' AND tanggal='$arr_tanggal[$i]'"));
}


$datachart = [
    ["total" => "$arrdat[0]",
     "tanggal" => "$arr_tanggal[0]",
    ],
    ["total" => "$arrdat[1]",
     "tanggal" => "$arr_tanggal[1]",
    ],
    ["total" => "$arrdat[2]",
     "tanggal" => "$arr_tanggal[2]",
    ],
    ["total" => "$arrdat[3]",
    "tanggal" => "$arr_tanggal[3]",
   ],
   ["total" => "$arrdat[4]",
     "tanggal" => "$arr_tanggal[4]",
    ],
    ["total" => "$arrdat[5]",
     "tanggal" => "$arr_tanggal[5]",
    ],
    ["total" => "$arrdat[6]",
    "tanggal" => "$arr_tanggal[6]",
   ]
  
];

// echo json_encode($datachart);

?>