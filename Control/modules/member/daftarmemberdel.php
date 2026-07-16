<?php
include "koneksi.php";

if (isset($_GET['idm'])) {
  $id_member = $_GET['idm'];

  $con = mysqli_connect($host, $user, $pass, $db);

  if (!$con) {
    die("Koneksi database gagal: " . mysqli_connect_error());
  }

  $sqlm = mysqli_query($con, "DELETE FROM member WHERE id_member = '$id_member'");

  if ($sqlm) {
    echo "<div align='center' class='alert alert-success'>
              <strong>Data Berhasil Dihapus!</strong>
          </div>";
  } else {
    echo "<div align='center' class='alert alert-danger'>
              <strong>Data Gagal Dihapus!</strong>
          </div>";
  }

  mysqli_close($con);
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=daftarmember'>";
} else {
  echo "ID member tidak valid.";
}
?>
