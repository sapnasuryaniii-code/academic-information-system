<?php 
//KONDISI DALAM PHP DIMANA 1 TRUE DAN 1 FALSE
//MEMAKAI IF - ELSE
//$nilai = 70;
   // if($nilai >= 70){
   //     echo "LULUS";
   // } 
   // else {
  //      echo "TIDAK LULUS";
 //   }

//KONDISI DALAM PHP DIMANA ADA 2 TRUE DAN 1 FALSE
//IF - ELSEIF - ELSE
//$jenis_kelamin = "P";
  //  if($jenis_kelamin == "L"){
    //    echo "Laki-Laki (peryataan benar 1)";
    //} 
   // elseif($jenis_kelamin == "P"){
     //   echo "Perempuan (peryataan benar 2)";
   // }
    //else {
      //  echo "thailand";
   // }

//KONDISI DALAM PHP DIMANA ADA 3 TRUE DAN 1 FALSE
//$kota = "PAYAKUMBUH";
  //  if($kota == "PAYAKUMBUH"){
    //    echo "KOTA PAYAKUMBUH KOTA WISATA (peryataan benar 1)";
    //} 
    //elseif($kota == "PADANG"){
      //  echo "KOTA PADANG KOTA PANTAI (peryataan benar 2)";
    //}
    //elseif($kota == "BUKITTINGGI"){
      //  echo "KOTA BUKITTINGGI KOTA BERSEJARAH (peryataan benar 3)";
    //}
    //else {
      //  echo "KOTA LAINNYA";
   // }    

 //KONDISI DALAM PHP DIMANA ADA 4 TRUE DAN 1 FALSE
$rentang_nilai = -101;
if($rentang_nilai >= 101){
        echo "Nilai Melebihi Batas Maksimal";
    }
    if($rentang_nilai >= 80 && $rentang_nilai <= 100){
        echo "Nilai A (peryataan benar 1)";
    } 
    elseif($rentang_nilai >= 64 && $rentang_nilai <= 79){
        echo "Nilai B (peryataan benar 2)";
    }
    elseif($rentang_nilai >= 56 && $rentang_nilai <= 63){
        echo "Nilai C (peryataan benar 3)";
    }
    elseif($rentang_nilai >= 40 && $rentang_nilai <= 55){
        echo "Nilai D (peryataan benar 4)";
    }
    elseif($rentang_nilai >= 0 && $rentang_nilai <= 39){
        echo "Nilai E (peryataan benar 5)";
    }    
    else {
        echo "Nilai Terlalu Rendah";
    }
?> 

