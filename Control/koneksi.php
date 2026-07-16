<?php
$host = getenv("DB_HOST") ?: "localhost";
$user = "root";
$pass = "";
$db = "cf_depresi";

// Membuat koneksi ke database
$con = mysqli_connect($host, $user, $pass, $db);

// Memeriksa koneksi
if (!$con) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Cuma buat ngetes doank
/*
if ($connection) {
    echo "Terkoneksi dengan MySQL<br>";
    if (mysqli_select_db($connection, $db)) {
        echo "Database $db bisa diakses";
    } else {
        echo "Database $db tidak ada";
    }
} else {
    echo "Gagal Koneksi";
}
*/
?>
