<?php
//PENENTU AKTIVITAS HARIAN
//$hari = "Sabtu"; // ubah sesuai kebutuhan

// Normalisasi agar huruf besar/kecil tidak berpengaruh
//$hari_lower = strtolower($hari);

//if($hari_lower == "senin" || $hari_lower == "selasa" || $hari_lower == "rabu" || $hari_lower == "kamis" || $hari_lower == "jumat"){
//    echo "Hari Kerja";
//}
//elseif($hari_lower == "sabtu" || $hari_lower == "minggu"){
//    echo "Hari Weekend";
//}
//else {
//    echo "Error: Hari tidak valid";
//}
//ANALISA BULAN DAN MUSIM
$bulan = 4; // angka 1-12

if($bulan >= 12 || $bulan <= 2){
    echo "Musim Hujan (Winter)";
}
elseif($bulan >= 3 && $bulan <= 5){
    echo "Musim Semi (Spring)";
}
elseif($bulan >= 6 && $bulan <= 8){
    echo "Musim Kemarau (Summer)";
}
elseif($bulan >= 9 && $bulan <= 11){
    echo "Musim Gugur (Autumn)";
}
else {
    echo "Error: Bulan tidak valid";
}
?>