<!DOCTYPE html>
<html>
<head>
  <title>Gejala Depresi Sandwich Generation</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="path_to_bootstrap_css/bootstrap.min.css">
</head>
<body>
  <center style="font-family: GreyscaleBasic; font-weight: bold;">
    <h1>Jenis dan Gejala Depresi Sandwich Generation</h1>
  </center>

  <p align="justify">Terdapat Tiga Jenis Depresi Sandwich Generation Yaitu: 
    <p>1. Depresi Sandwich Generation (Ringan) </p> 
    <p>2. Depresi Sandwich Generation (Sedang) </p>
    <p>3. Depresi Sandwich Generation (Berat) </p>
  <p align="justify">Dibawah ini merupakan sedikit penjelasan tentang depresi sandwich generation:</p>

  <p align="left" width="100%">
    <a class="btn btn-info" data-toggle="collapse" href="#p1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">1. Depresi Sandwich Generation Ringan </a>
  </p>
  <div class="collapse multi-collapse" id="p1">
    <div class="card card-body">
      <?php
      include "koneksi.php";
      $sqlp = mysqli_query($con, "select * from penyakit where kd_penyakit='K01'");
      $rp = mysqli_fetch_array($sqlp);
      ?>
      <p align="justify"><?php echo $rp['keterangan']; ?></p>
      <p align="justify">Hal yang dapat dilakukan jika terdiagnosa ini adalah: <?php echo $rp['penanggulangan']; ?></p>
      <p align="justify">Berikut adalah daftar gejalanya:<br>
        <table class="table table-hover table-sm table-bordered">
          <thead>
            <tr id="thpo">
              <th>No</th>
              <th>Kode Gejala</th>
              <th>Nama gejala</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sqlg = mysqli_query($con, "select * from gejala where kd_penyakit='K01'");
            $no = 1;
            while ($rg = mysqli_fetch_array($sqlg)) {
              echo "<tr>
                      <td>$no</td>
                      <td>$rg[kd_gejala]</td>
                      <td>$rg[nama_gejala]</td>
                    </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </p>
    </div>
  </div>

  <p align="left">
    <a class="btn btn-info" data-toggle="collapse" href="#p2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">2. Depresi Sandwich Generation Sedang </a>
  </p>
  <div class="collapse multi-collapse" id="p2">
    <div class="card card-body">
      <?php
      $sqlp = mysqli_query($con, "select * from penyakit where kd_penyakit='K02'");
      $rp = mysqli_fetch_array($sqlp);
      ?>
      <p align="justify"><?php echo $rp['keterangan']; ?></p>
      <p align="justify">Hal yang dapat dilakukan jika terdiagnosa ini adalah: <?php echo $rp['penanggulangan']; ?></p>
      <p align="justify">Berikut adalah daftar gejalannya:<br>
        <table class="table table-hover table-sm table-bordered">
          <thead>
            <tr id="thpo">
              <th>No</th>
              <th>Kode Gejala</th>
              <th>Nama gejala</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sqlg = mysqli_query($con, "select * from gejala where kd_penyakit='K02'");
            $no = 1;
            while ($rg = mysqli_fetch_array($sqlg)) {
              echo "<tr>
                      <td>$no</td>
                      <td>$rg[kd_gejala]</td>
                      <td>$rg[nama_gejala]</td>
                    </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </p>
    </div>
  </div>

  <p align="left">
    <a class="btn btn-info" data-toggle="collapse" href="#p3" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">3. Depresi Sandwich Generation Berat </a>
  </p>
  <div class="collapse multi-collapse" id="p3">
    <div class="card card-body">
      <?php
      $sqlp = mysqli_query($con, "select * from penyakit where kd_penyakit='K03'");
      $rp = mysqli_fetch_array($sqlp);
      ?>
      <p align="justify"><?php echo $rp['keterangan']; ?></p>
      <p align="justify">Hal yang dapat dilakukan jika terdiagnosa ini adalah: <?php echo $rp['penanggulangan']; ?></p>
      <p align="justify">Berikut adalah daftar gejalannya:<br>
        <table class="table table-hover table-sm table-bordered">
          <thead>
            <tr id="thpo">
              <th>No</th>
              <th>Kode Gejala</th>
              <th>Nama gejala</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sqlg = mysqli_query($con, "select * from gejala where kd_penyakit='K03'");
            $no = 1;
            while ($rg = mysqli_fetch_array($sqlg)) {
              echo "<tr>
                      <td>$no</td>
                      <td>$rg[kd_gejala]</td>
                      <td>$rg[nama_gejala]</td>
                    </tr>";
              $no++;
            }
            ?>
          </tbody>
        </table>
      </p>
    </div>
  </div>

  <script src="path_to_bootstrap_js/bootstrap.min.js"></script>
</body>
</html>
