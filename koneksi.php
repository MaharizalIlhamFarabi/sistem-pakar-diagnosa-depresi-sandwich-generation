<?php
$host   = getenv("DB_HOST") ?: "localhost";
$user   = "root";
$pass   = "";
$db     = "cf_depresi";

$con = mysqli_connect($host, $user, $pass, $db);

// Periksa koneksi
if (!$con) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Cuma buat ngetes doank
/*if($con){
    echo "Terkoneksi dengan MySQL<br>";
    if($condb){
        echo "Database $db bisa diakses";
    }else{
        echo "Database $db tidak ada";
    }
}else{
    echo "Gagal Koneksi";
}*/
?>
