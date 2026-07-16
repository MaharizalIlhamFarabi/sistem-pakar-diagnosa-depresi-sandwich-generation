<?php
include "koneksi.php";

if (isset($_POST["kirim"])) {
    $idpe = $_GET['idpe'] ?? '';

    $mysqli = new mysqli("localhost", "root", "", "cf_depresi");

    if ($mysqli->connect_error) {
        die("Koneksi gagal: " . $mysqli->connect_error);
    }

    $cek = $mysqli->query("SELECT * FROM pesanm WHERE id_member='$idpe'");
    $rcek = $cek->num_rows;

    if ($rcek > 0) {
        $pesan = nl2br($_POST["balaspesan"]);
        $idpesan = $_POST["id_pesan"];
        $idbalas = $_POST["id_balas"];

        $sqlbp = $mysqli->query("INSERT INTO balas_pesan (id_member, id_pesan, pesan, status, waktu) VALUES ('$idpe', '$idpesan', '$pesan', 'notyet', NOW())");
        $mysqli->query("UPDATE pesanm SET status='ok' WHERE id_balas='$idbalas' AND id_member='$idpe'");

        if ($sqlbp) {
            echo "<div align='center' class='alert alert-success'>
                        <strong>Pesan Berhasil Dikirim!
                    </div>";
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=lihatpesan&idpe=$idpe'>";
        } else {
            echo "<div align='center' class='alert alert-danger'>
                        <strong>Pesan Gagal Dikirim!
                    </div>";
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=lihatpesan&idpe=$idpe'>";
        }
    } else {
        $sqlcek = $mysqli->query("UPDATE pesanm SET status='ok' WHERE id_balas='$idbalas' AND id_member='$idpe'");

        if ($sqlcek) {
            echo "<div align='center' class='alert alert-danger'>
                        <strong>Sesi Pesan ini sudah dihapus user!
                    </div>";
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=pesan'>";
        } else {
            // Handle error jika perlu
        }
    }

    $mysqli->close();
}
$mysqli = new mysqli("localhost", "root", "", "cf_depresi");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$idpe = $_GET['idpe']; // Pastikan Anda mengamankan input ini sesuai kebutuhan Anda.

$sqlpe = $mysqli->query("SELECT * FROM pesanm WHERE id_member='$idpe' ORDER BY id_pesanm ASC");

$testing = mysqli_num_rows($mysqli->query("SELECT * FROM pesanm WHERE id_member='$idpe' "));

if ($testing > 0) {
    echo "  <p>
        <button data-toggle='modal' data-target='#myModal' class='btn btn-dangerpesan'><span class='glyphicon glyphicon-trash'></span>Hapus Semua Pesan</button>
    </p>";

    while ($rpe = $sqlpe->fetch_assoc()) {
        $tgl = substr($rpe["waktu"], 8, 2);
        $bln = substr($rpe["waktu"], 5, 2);
        $thn = substr($rpe["waktu"], 0, 4);
        $jam = substr($rpe["waktu"], 11, 5);

        if ($rpe["status"] == "notyet") {
            $warna = "id='wellbaru'";
        } else {
            $warna = "";
        }

        echo "
        <div class='well well-lg' $warna;><p align='left'>$rpe[pesan] </p><p align='left'><font color='cccccc'>$tgl-$bln-$thn  ($jam)</font></p> </div>
        ";

        $sqlpeb = $mysqli->query("SELECT * FROM balas_pesan WHERE id_member='$idpe' AND id_pesan='$rpe[id_pesanm]'");
        while ($rpeb = $sqlpeb->fetch_assoc()) {
            $tgl2 = substr($rpeb["waktu"], 8, 2);
            $bln2 = substr($rpeb["waktu"], 5, 2);
            $thn2 = substr($rpeb["waktu"], 0, 4);
            $jam2 = substr($rpeb["waktu"], 11, 5);

            if ($rpeb > 0) {
                echo "
                <div class='well well-lg' ><p align='right'>$rpeb[pesan] </p><p align='right'><font color='cccccc'>$tgl2-$bln2-$thn2  ($jam2)</font></p></div>
                ";
            } else {
            }
        }
    }
    $q_idbalas = $mysqli->query("SELECT id_balas FROM pesanm WHERE id_member='$idpe' ORDER BY id_pesanm DESC LIMIT 1");
    $qidbalas = $q_idbalas->fetch_assoc();

    $q_idpesan = $mysqli->query("SELECT MAX(id_pesanm) AS id_pesanm FROM pesanm WHERE id_member='$idpe'");
    $qidpesan = $q_idpesan->fetch_assoc();
}

$mysqli->close();
?>

<form name="form1" method="post" action="" enctype="multipart/form-data">
  <p>
    <input name="id_pesan" type="hidden" class="form-control" value="<?php echo $qidpesan['id_pesanm']; ?>">
    <input name="id_balas" type="hidden" class="form-control" value="<?php echo $qidbalas['id_balas']; ?>">
    <textarea name="balaspesan" class="form-control" type="text"></textarea>
  </p>

  <p>
    <input name="kirim" type="submit" id="simpan" class="btn btn-success" value="BALAS PESAN">
    <a href='?r=pesan' class='btn btn-warning'>Batal</a>
  </p>
</form>

<!--HAPUS ALL PESAN -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <form action="" method="post">
          <h4 class="modal-title">Konfirmasi</h4>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Akan menghapus semua kotak masuk?
      </div>
      <div class="modal-footer">
        <input name="hapus" type="submit" class="btn btn-primary" id="hapus" value="hapus">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
if (isset($_POST["hapus"])) {
  include "koneksi.php";
  mysqli_query($con, "DELETE FROM balas_pesan WHERE id_member='$id_member'");
  mysqli_query($con, "DELETE FROM pesanm WHERE id_member='$id_member'");

  echo "<div align='center'class='alert alert-success'>
          <strong>Pesan Berhasil Dihapus!
        </div>";
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=pesan'>";
}
else {
  echo "<p ><center style='font-family:GreyscaleBasic;font-weight:bold;'>TIDAK ADA KOTAK MASUK </center></p>";
}
?>
<p align="right">
  <button class="btn btn-success" value="Scroll Top" id="tombolScrollTop" onclick="scrolltotop()">
    <span class='glyphicon glyphicon-arrow-up'></span>
  </button>
</p>
<script>
function scrolltotop() {
  $('html, body').animate({ scrollTop: 0 }, 500);
}
</script>
