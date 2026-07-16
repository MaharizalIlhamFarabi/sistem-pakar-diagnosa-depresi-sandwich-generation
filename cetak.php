<?php session_start(); ?>

<style type="text/css">
body {
    font-family: Arial;
    font-size: 13px;
}
</style>

<?php
include "koneksi.php";

$no_konsul = $_GET['no_konsul'];

$sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
$rm = mysqli_fetch_array($sqlm);
$sqlu = mysqli_query($con, "SELECT YEAR(curdate()) - YEAR(tgl_lahir) AS umur FROM member WHERE username='$_SESSION[usermbr]'");
$ru = mysqli_fetch_array($sqlu);
?>

<body onLoad="window.print();window.closeoff()">
<fieldset>
<h3>SISTEM PAKAR DIAGNOSA DEPRESI SANDWICH GENERATION</h3>
<fieldset>
NO KONSULTASI : <big><b><?php echo "$no_konsul"; ?></b></big>
</fieldset>
<fieldset>
<h3>DATA MEMBER</h3>
<p>Nama Lengkap<br>
<big><?php echo "$rm[nama]"; ?></big></p>
<p>UMUR<br>
<big><?php echo "$ru[umur]"; ?></big></p>
<p>Alamat<br>
<big><?php echo "$rm[alamat]"; ?></big></p>

</fieldset>

<fieldset>
<h3>DATA DIAGNOSA</h3>
<table class="" border="1" cellpadding="5" cellspacing="0" width="100%" border="1" align="center">
<thead>
    <tr>
      <th colspan="3" align="center" bgcolor="#CCCCCC"><strong> Gejala Yang Anda Miliki Adalah :</strong></th>
  </tr>
</thead>
<tbody>

<?php
$no = 1;
$strsqlku = mysqli_query($con, "SELECT * FROM konsultasi WHERE id_member=$rm[id_member] AND no_konsul='$_GET[no_konsul]'");
while ($row = mysqli_fetch_array($strsqlku)) {
    $strsqlku2 = mysqli_query($con, "SELECT * FROM gejala WHERE kd_gejala='$row[kd_gejala]'");
    while ($row2 = mysqli_fetch_array($strsqlku2)) {

        echo "<tr>";
        echo    "<td width='5%'>$no</td>";
        echo    "<td width='50%'>$row2[nama_gejala]</td>";
        echo    "<td width='50%'>Nilai Kepastian Gejala : $row[cf]</td>";
        echo"</tr>";

        $no++;
    }
}
?>
</tbody>
</table>
<?php

$sqlh = mysqli_query($con, "SELECT * FROM hasil_konsultasi WHERE id_member='$rm[id_member]' AND no_konsul='$_GET[no_konsul]'");
while ($rh = mysqli_fetch_array($sqlh)) {

    $angka = $rh['max'];

    $sqlhp = mysqli_query($con, "SELECT * FROM penyakit WHERE kd_penyakit='$rh[kd_penyakit]'");
    $rhp = mysqli_fetch_array($sqlhp);
}
?>
<table cellpadding="5" cellspacing="0" width='100%' border='1' align='center'>
<thead>
    <tr>
      <th colspan='3' align='center' bgcolor='#CCCCCC'><strong> KESIMPULAN</strong></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td>Kemungkinan anda terindikasi : <?php echo "$rhp[nama_penyakit]"; ?> <?php echo "$angka %"; ?></td>
</tr>
</tbody>
</table>

</fieldset>
<fieldset>
&copy; SISTEM PAKAR DIAGNOSA ADIKSI GAME ONLINE
</fieldset>
</body>
</fieldset>
