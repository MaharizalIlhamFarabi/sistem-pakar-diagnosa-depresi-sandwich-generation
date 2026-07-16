<?php
include "koneksi.php";

$mysqli = new mysqli(getenv("DB_HOST") ?: "localhost", "root", "", "cf_depresi");

if ($mysqli->connect_error) {
    die("Koneksi database gagal: " . $mysqli->connect_error);
}

$sqlm = $mysqli->query("select * from member where username='$_SESSION[usermbr]'");
$rm = $sqlm->fetch_assoc();

$sqlh = $mysqli->query("select * from hasil_konsultasi where id_member='$rm[id_member]' order by no_konsul desc");

?>

<div>
    <a href='?r=hasilkonsultasi' class='btn btn-success'><span class='glyphicon glyphicon-edit'></span> Back</a>
</div>
<div class="table-responsive">
    <table class="table table-hover table-sm table-bordered">
        <thead id="thpo">
            <tr id='thpo'>
                <th width='5%' class="text-center">NO</th>
                <th class="text-center">HASIL DIAGNOSA KERUSAKAN</th>
                <th class="text-center">GEJALA</th>
                <th class="text-center">CF</th>
                <th width='20%' class="text-center">WAKTU KONSULTASI</th>
                <th width='20%' class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody class="">
            <?php

            $no = 1;
            while ($rh = $sqlh->fetch_assoc()) {

                $tgl = substr($rh["waktu"], 8, 2);
                $bln = substr($rh["waktu"], 5, 2);
                $thn = substr($rh["waktu"], 0, 4);
                $jam = substr($rh["waktu"], 11, 5);

                $cekmax = $rh['max'];

                if ($cekmax > 0) {

                    $sqlhp = $mysqli->query("select * from penyakit where kd_penyakit='$rh[kd_penyakit]'");
                    $rhp = $sqlhp->fetch_assoc();

                    $sqlhg = $mysqli->query("select * from hasil_konsultasi,konsultasi where hasil_konsultasi.no_konsul=konsultasi.no_konsul
      and hasil_konsultasi.no_konsul='$rh[no_konsul]'
      and konsultasi.no_konsul='$rh[no_konsul]'");

                    $gejala = array();

                    while ($rhg = $sqlhg->fetch_assoc()) {

                        $namagejala = $mysqli->query("select * from gejala where kd_gejala='$rhg[kd_gejala]'");
                        $rng = $namagejala->fetch_assoc();

                        $gejala[] = $rng['nama_gejala'];
                    }

                    echo "<tr>
    <td >$no</td>
    <td>- " . implode('<br>- ', $gejala) . "</td>
    <td>$rh[max]</td>
    <td>$tgl-$bln-$thn    ( $jam )</td>
    <td align='center'><a href='cetak.php?&no_konsul=$rh[no_konsul]' target='_blank'><button type='button' id='' class='btn btn-info'> CETAK</button></a>
    </td>
  </tr>";

                    $no++;
                } else {

                    $sqlhp = $mysqli->query("select * from penyakit where kd_penyakit='$rh[kd_penyakit]'");
                    $rhp = $sqlhp->fetch_assoc();

                    $sqlhg = $mysqli->query("select * from hasil_konsultasi,konsultasi where hasil_konsultasi.no_konsul=konsultasi.no_konsul
      and hasil_konsultasi.no_konsul='$rh[no_konsul]'
      and konsultasi.no_konsul='$rh[no_konsul]'");

                    $gejala = array();

                    while ($rhg = $sqlhg->fetch_assoc()) {

                        $namagejala = $mysqli->query("select * from gejala where kd_gejala='$rhg[kd_gejala]'");
                        $rng = $namagejala->fetch_assoc();

                        $gejala[] = $rng['nama_gejala'];
                    }

                    echo "<tr>
    <td >$no</td>
    <td>Tidak Terindikasi penyakit</td>
    <td>- " . implode('<br>- ', $gejala) . "</td>
    <td>$rh[max]</td>
    <td>$tgl-$bln-$thn    ( $jam )</td>
    <td align='center'>----</td>
  </tr>";

                    $no++;
                }
            }
            ?>

        </tbody>

    </table>
</div>

<p align="right"> <button class="btn btn-success" value="Scroll Top" id="tombolScrollTop" onclick="scrolltotop()"><span class='glyphicon glyphicon-arrow-up'></span></button>
</p>

<script>
    function scrolltotop() {
        $('html, body').animate({
            scrollTop: 0
        }, 500);
    }
</script>
