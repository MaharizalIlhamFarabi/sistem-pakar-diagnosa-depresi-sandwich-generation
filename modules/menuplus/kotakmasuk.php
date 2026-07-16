<?php
include "koneksi.php";

$mysqli = new mysqli(getenv("DB_HOST") ?: "localhost", "root", "", "cf_depresi");

if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

$sqlm = $mysqli->query("select * from member where username='$_SESSION[usermbr]'");
$rm = $sqlm->fetch_assoc();

// HAPUS PESAN
if (isset($_POST["hapus"])) {
    $id_member = $rm["id_member"];
    $sqlpe = $mysqli->query("delete from pesanm where id_member=$rm[id_member]");
    $mysqli->query("update balas_pesan set status='ok' where id_member='$id_member'");

    if ($sqlpe) {
        echo "<div align='center' class='alert alert-success'>
                <strong>Pesan Berhasil Dihapus!
              </div>";
    } else {
        echo "<div align='center' class='alert alert-danger'>
                <strong>Pesan Gagal Dihapus!
              </div>";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=homemember'>";
}

// QUERY KIRIM BALIK PESAN
if (isset($_POST["kirim"])) {
    $pesan = nl2br($_POST["balaspesan"]);
    $id_member = $rm["id_member"];

    $sqlpe = $mysqli->query("insert into pesanm (id_member, id_balas, pesan, status, waktu) values ('$id_member', '$_POST[id_balas]', '$pesan','notyet', NOW())");
    $mysqli->query("update balas_pesan set status='ok' where id_pesan='$_POST[id_pesan]' and id_member='$id_member'");

    if ($sqlpe) {
        echo "<div align='center' class='alert alert-success'>
                <strong>Pesan Berhasil Dikirim!
              </div>";
    } else {
        echo "<div align='center' class='alert alert-danger'>
                <strong>Pesan Gagal Dikirim!
              </div>";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=kotakmasuk'>";
}

$sqlm = $mysqli->query("select * from member where username='$_SESSION[usermbr]'");
$rm = $sqlm->fetch_assoc();

$sqlpe = $mysqli->query("select * from pesanm where id_member='$rm[id_member]' order by id_pesanm asc");

$testing = mysqli_num_rows($mysqli->query("SELECT * FROM pesanm where id_member='$rm[id_member]' "));

if ($testing > 0) {
    echo "<p>
            <button data-toggle='modal' data-target='#myModal' class='btn btn-dangerpesan'><span class='glyphicon glyphicon-trash'></span>Hapus Semua Pesan</button>
        </p>";

    while ($rpe = $sqlpe->fetch_assoc()) {
        $tgl = substr($rpe["waktu"], 8, 2);
        $bln = substr($rpe["waktu"], 5, 2);
        $thn = substr($rpe["waktu"], 0, 4);
        $jam = substr($rpe["waktu"], 11, 5);

        echo "
              <div class='well well-lg '><p align='right'>$rpe[pesan] </p><p align='right'><font color = 'cccccc'>$tgl-$bln-$thn  ($jam)</font></p> </div>
              ";

        $sqlpeb = $mysqli->query("select * from balas_pesan where id_member='$rm[id_member]' and id_pesan='$rpe[id_pesanm]'");
        while ($rpeb = $sqlpeb->fetch_assoc()) {
            $tgl2 = substr($rpeb["waktu"], 8, 2);
            $bln2 = substr($rpeb["waktu"], 5, 2);
            $thn2 = substr($rpeb["waktu"], 0, 4);
            $jam2 = substr($rpeb["waktu"], 11, 5);

            if ($rpeb > 0) {
                if ($rpeb["status"] == "notyet") {
                    $warna = "id='wellbaru'";
                } else {
                    $warna = "";
                }

                echo "
              <div class='well well-lg' $warna;  ><p align='left'>$rpeb[pesan] </p><p align='left'><font color = 'cccccc'>$tgl2-$bln2-$thn2  ($jam2)</font></p></div>
              ";
            } else {}
        }
    }

    $q_idbalas = $mysqli->query("select max(id_balas) as id_balasku from balas_pesan where id_member='$rm[id_member]'");
    $qidbalas = $q_idbalas->fetch_assoc();
    $q_idpesan = $mysqli->query("select max(id_pesan) as id_pesanku from balas_pesan where id_member='$rm[id_member]'");
    $qidpesan = $q_idpesan->fetch_assoc();

    echo "<form name='form1' method='post' action='' enctype='multipart/form-data'>
<p>
    <input name='id_balas' type='hidden' class='form-control'  value='" . $qidbalas['id_balasku'] . "' >
    <input name='id_pesan' type='hidden' class='form-control'  value='" . $qidpesan['id_pesanku'] . "' >
    <textarea name='balaspesan' class='form-control' type='text'  ></textarea>  </p>

  <p>
    <input name='kirim' type='submit' id='simpan' class='btn btn-success' value='KIRIM PESAN'>
    <a href='?r=homemember' class='btn btn-warning' >Batal</a>
</p>
</form>";

    // HAPUS ALL PESAN

    echo "<div id='myModal' class='modal fade'>
 	<div class='modal-dialog modal-lg '>
 		<div class='modal-content '>
 			<div class='modal-header'>
	       <form action='' method='post'>
 				      <h4 class='modal-title'>Konfirmasi</h4>
 			</div>
 			<div class='modal-body'>
 				Apakah Anda Yakin Akan menghapus semua kotak masuk?<br>
        Note : Jika Anda menghapus semua pesan sekarang, anda tidak bisa lagi menerima balasan dari admin untuk sesi pesan ini. untuk pesan selanjutnya silahkan kirim melalui menu Kirim Pesan.

 				</div>
 				<div class='modal-footer'>
 				  <input name='hapus' type='submit' class='btn btn-primary' id='hapus' value='hapus'>
 					<button type='button' class='btn btn-warning' data-dismiss='modal'>Batal</button>

 				</div>
</form>
</div>
</div>
</div>";
} else {
    echo "<p ><center style='font-family:GreyscaleBasic;font-weight:bold;'>TIDAK ADA KOTAK MASUK </center></p>";
}
?>
<p align="right">  <button class="btn btn-success" value="Scroll Top" id="tombolScrollTop" onclick="scrolltotop()"><span class='glyphicon glyphicon-arrow-up'></span></button>
</p>

<script>
    function scrolltotop() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    }
</script>
