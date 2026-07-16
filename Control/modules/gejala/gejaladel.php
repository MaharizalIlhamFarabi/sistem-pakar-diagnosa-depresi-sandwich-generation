<?php
include "koneksi.php";
$sqlg = mysqli_query($con, "DELETE FROM gejala WHERE id_gejala='$_GET[idg]'");
if ($sqlg) {
    echo "<div align='center' class='alert alert-success'>
              <strong>Data Berhasil Dihapus!</strong>
            </div>";
} else {
    echo "<div align='center' class='alert alert-success'>
                <strong>Data Gagal Dihapus!</strong>
                  </div>";
}
echo "<META HTTP-EQUIV='Refresh' Content='1; url=?r=gejala'>";
?>
