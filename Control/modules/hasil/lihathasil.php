<?php include "koneksi.php";

$sqlh = mysqli_query($con, "SELECT * FROM hasil_konsultasi WHERE id_member='$_GET[idh]'  ORDER BY no_konsul DESC");
?>

<div>
  <a href='?r=hasilkonsultasi' class='btn btn-success'> <span class='glyphicon glyphicon-circle-arrow-left'></span>Back</a>
</div>
<div class="table-responsive">
  <table class="table table-hover table-sm table-bordered">
    <thead class="bg-primary">
      <tr id="thpo">
        <th width='5%' class="text-center" rowspan="2">NO</th>
        <th class="text-center" rowspan="2">GEJALA</th>
        <th class="text-center" colspan="4">CF</th>
        <th width='10%' class="text-center" rowspan="2">HASIL AKHIR</th>
        <th width='19%' class="text-center" rowspan="2">KERUSAKAN</th>
        <th width='10%' class="text-center" rowspan="2">WAKTU KONSULTASI</th>
      </tr>
      <tr id="thpo">
        <th width='10%' class="text-center">P01</th>
        <th width='10%' class="text-center">P02</th>
        <th width='10%' class="text-center">P03</th>
        <th width='10%' class="text-center">P04</th>
      </tr>
    </thead>

    <tbody class="">
      <?php
      $no = 1;
      while ($rh = mysqli_fetch_array($sqlh)) {
        $tgl = substr($rh["waktu"], 8, 2);
        $bln = substr($rh["waktu"], 5, 2);
        $thn = substr($rh["waktu"], 0, 4);
        $jam = substr($rh["waktu"], 11, 5);

        $cekmax = $rh['max'];

        if ($cekmax > 0) {

          $sqlhp = mysqli_query($con, "SELECT * FROM penyakit WHERE kd_penyakit='$rh[kd_penyakit]'");
          $rhp = mysqli_fetch_array($sqlhp);

          $sqlhg = mysqli_query($con, "SELECT * FROM hasil_konsultasi,konsultasi WHERE hasil_konsultasi.no_konsul=konsultasi.no_konsul
              AND hasil_konsultasi.no_konsul='$rh[no_konsul]'
              AND konsultasi.no_konsul='$rh[no_konsul]' ");

          $gejala = array();
          while ($rhg = mysqli_fetch_array($sqlhg)) {
            $gejala[] = $rhg['kd_gejala'];
          }

          $r1 = $rh["cf1"];
          $r2 = $rh["cf2"];
          $r3 = $rh["cf3"];
          $r4 = $rh["cf4"];

          $r11 = $r1 * 100;
          $r22 = $r2 * 100;
          $r33 = $r3 * 100;
          $r44 = $r4 * 100;

          echo "<tr>
           <td >$no</td>
           <td>" . implode(', ', $gejala) . "</td>
           <td>$r11%</td>
           <td>$r22%</td>
           <td>$r33%</td>
           <td>$r44%</td>
           <td>$rh[max]%</td>
           <td>$rhp[nama_penyakit]</td>
           <td>$tgl-$bln-$thn    ( $jam )</td>
         </tr>";

          $no++;
        } else {
          $sqlhp = mysqli_query($con, "SELECT * FROM penyakit WHERE kd_penyakit='$rh[kd_penyakit]'");
          $rhp = mysqli_fetch_array($sqlhp);

          $sqlhg = mysqli_query($con, "SELECT * FROM hasil_konsultasi,konsultasi WHERE hasil_konsultasi.no_konsul=konsultasi.no_konsul
          AND hasil_konsultasi.no_konsul='$rh[no_konsul]'
          AND konsultasi.no_konsul='$rh[no_konsul]' ");

          $gejala = array();
          while ($rhg = mysqli_fetch_array($sqlhg)) {
            $gejala[] = $rhg['kd_gejala'];
          }

          $r1 = $rh["cf1"];
          $r2 = $rh["cf2"];
          $r3 = $rh["cf3"];
          $r4 = $rh["cf4"];

          $r11 = $r1 * 100;
          $r22 = $r2 * 100;
          $r33 = $r3 * 100;
          $r44 = $r4 * 100;

          echo "<tr>
        <td >$no</td>
        <td>" . implode(', ', $gejala) . "</td>
        <td>$r11%</td>
        <td>$r22%</td>
        <td>$r33%</td>
        <td>$r44%</td>
        <td>$rh[max]%</td>
        <td>Tidak Terindikasi penyakit</td>
        <td>$tgl-$bln-$thn    ( $jam )</td>
        </tr>";

          $no++;
        }
      }
      ?>
    </tbody>
  </table>
</div>
