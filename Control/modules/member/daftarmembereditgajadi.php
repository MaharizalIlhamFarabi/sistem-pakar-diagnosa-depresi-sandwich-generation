<?php
include "koneksi.php";

if (isset($_GET['idm'])) {
  $id_member = $_GET['idm'];

  $con = mysqli_connect($hostname, $username, $password, $database);

  if (!$con) {
    die("Koneksi database gagal: " . mysqli_connect_error());
  }

  $sqlm = mysqli_query($con, "SELECT * FROM member WHERE id_member = '$id_member'");
  $rm = mysqli_fetch_array($sqlm);

  if (!$rm) {
    die("Data member tidak ditemukan.");
  }

  if (isset($_POST["simpan"])) {
    $alamat = nl2br($_POST["alamat"]);
    $umur = $_POST["umur"];
    $password = $_POST["password"];

    $query = "UPDATE member SET nama=?, jk=?, alamat=?, umur=?, password=? WHERE id_member=?";
    $stmt = mysqli_prepare($con, $query);

    if ($stmt) {
      mysqli_stmt_bind_param($stmt, "sssssi", $_POST["nama"], $_POST["jk"], $alamat, $umur, $password, $id_member);
      $result = mysqli_stmt_execute($stmt);

      if ($result) {
        echo "Data Berhasil Disimpan";
      } else {
        echo "Penyimpanan Data Gagal: " . mysqli_error($con);
      }

      mysqli_stmt_close($stmt);
    } else {
      echo "Penyimpanan Data Gagal: " . mysqli_error($con);
    }

    mysqli_close($con);
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=daftarmember'>";
  }
?>
<form name="form1" method="post" action="" enctype="multipart/form-data">
  <p>UBAH DATA USER</p>
  <input type="hidden" name="id_member" value="<?php echo $rm['id_member']; ?>" />
  <p>Username
    <input name="username" class="form-control" type="text" id="username" class="form-control" value="<?php echo $rm['username']; ?>" disabled>
  </p>
  <p>Password
    <input name="password" class="form-control" type="text" id="password" class="form-control" value="<?php echo $rm['password']; ?>">
  </p>
  <p>Nama Lengkap
    <input name="nama" class="form-control" type="text" id="namalengkap" class="form-control" value="<?php echo $rm['nama']; ?>">
  </p>
  <p>Alamat
    <textarea name="alamat" class="form-control" type="text" id="alamat"><?php echo $rm['alamat']; ?></textarea>
  </p>
  <?php
  $p = ($rm["jk"] == "pria") ? "checked" : "";
  $w = ($rm["jk"] == "wanita") ? "checked" : "";
  ?>
  <p>JENIS KELAMIN <br>
    <input name="jk" type="radio" value="pria" <?php echo $p; ?>>
    Pria
    <input name="jk" type="radio" value="wanita" <?php echo $w; ?>>
    Wanita
  </p>
  <p>Umur
    <input name="umur" type="text" id="umur" class="form-control" value="<?php echo $rm['umur']; ?>">
  </p>
  <input name="simpan" type="submit" id="simpan" class="btn btn-info" value="SIMPAN DATA MEMBER">
  <a href='?r=member&idm=<?php echo $rm['id_member']; ?>' class='btn btn-warning'>Batal</a>
  </p>
</form>
<?php
} else {
  echo "ID member tidak valid.";
}
?>
