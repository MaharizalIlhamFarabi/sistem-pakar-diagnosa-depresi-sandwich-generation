<?php
include "koneksi.php";
$sqlp = mysqli_query($con, "SELECT * FROM penyakit WHERE id_penyakit='$_GET[idp]'");
$rp = mysqli_fetch_array($sqlp);
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
  <p>UBAH DATA Gejala</p>
  <input type="hidden" name="id_penyakit" value="<?php echo $rp['id_penyakit']; ?>">
  <p>Kode Gejala
    <input name="kd_penyakit" class="form-control" type="text" value="<?php echo $rp['kd_penyakit']; ?>" disabled>
  </p>
  <p>Nama Gejala
    <input name="nama_penyakit" class="form-control" type="text" value="<?php echo $rp['nama_penyakit']; ?>" disabled>
  </p>
  <p>Keterangan
    <textarea name="keterangan" class="form-control" type="text"><?php echo $rp['keterangan']; ?></textarea>
  </p>
  <p>Saran
    <textarea name="penanggulangan" class="form-control" type="text"><?php echo $rp['penanggulangan']; ?></textarea>
  </p>

  <p>
    <input name="simpan" type="submit" id="simpan" class="btn btn-info" value="SIMPAN DATA PENYAKIT">
    <a href='?r=penyakit&idp=<?php echo $rp['id_penyakit']; ?>' class='btn btn-warning'>Batal</a>
  </p>
</form>

<?php
if(isset($_POST["simpan"])){
  include "koneksi.php";
  $keterangan = nl2br($_POST["keterangan"]);
  $penanggulangan = nl2br($_POST["penanggulangan"]);
  $sqlp = mysqli_query($con, "UPDATE penyakit SET keterangan='$keterangan', penanggulangan='$penanggulangan' WHERE id_penyakit='$rp[id_penyakit]'");
  if($sqlp){
    echo "Data Berhasil Disimpan";
  }else{
    echo "Penyimpanan Data Gagal";
  }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=penyakit'>";
}
?>
