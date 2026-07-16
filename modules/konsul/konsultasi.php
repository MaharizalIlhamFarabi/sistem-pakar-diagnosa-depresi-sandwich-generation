<?php include "koneksi.php"; ?>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if(isset($_POST["periksa"])){

    $sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
    $rm = mysqli_fetch_array($sqlm);
    $namamember = $rm['nama'];
    $idmember = $rm['id_member'];


    // penambahan no konsul
    $qno_konsul = mysqli_query($con, "SELECT MAX(no_konsul) AS max_no FROM konsultasi");
    $array_max_no = mysqli_fetch_array($qno_konsul);
    $no_konsul = $array_max_no[0] + 1;

    $totalg = mysqli_query($con, "SELECT * FROM gejala");
    $rtotal = mysqli_num_rows($totalg);

    //print_r($_POST);exit();

    for($i = 1; $i <= $rtotal; $i++){
        $ngejala = $_POST['gejala'.$i];
        $ncf = $_POST['cf'.$i];
        $nnama = $_POST['nama'.$i];

        if(!empty($ngejala) && !empty($ncf)){
            $date = date('Y-m-d');

            $querykonsul = mysqli_query($con, "INSERT INTO konsultasi (id_member, no_konsul, kd_gejala, cf, tanggal) VALUES ('$idmember', '$no_konsul', '$ngejala', '$ncf', '$date')");

        } else if(empty($ngejala) || empty($ncf)){
            echo "<meta http-equiv=Refresh content=2;url=?r=konsultasi>";
        }
    }

    if($querykonsul){
        echo "<div align='center' class='alert alert-success'>
              <strong>Berhasil konsultasi!</strong>
              </div>";
        echo "<meta http-equiv=Refresh content=1;url=?r=rule&no_konsul=$no_konsul>";
    } else {
        echo "<div align='center' class='alert alert-danger'>
              <strong>Silahkan isi data konsultasi dengan benar!</strong>
              </div>";
        echo "<meta http-equiv=Refresh content='1; url=?r=konsultasi'>";
    }

}

?>


<?php

$sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
$rm = mysqli_fetch_array($sqlm);

?>

<a href='?r=hasilkonsul' class='btn btn-info'><span class='glyphicon glyphicon-list'></span> LIHAT HASIL KONSUL SEBELUMNYA</a>
<center style='font-family:GreyscaleBasic;font-weight:bold;'><h3>Silahkan Jawab Nilai Kepastian Yang Anda Rasakan Dari Setiap Pertanyaan Gejala Yang Ada</h3></center>
<center style='font-family:GreyscaleBasic;font-weight:bold;'><h4>Rentang Nilai Kepastian jika anda merasa = Sangat Yakin: 1, Yakin: 0,8, Cukup Yakin: 0,6, Sedikit Yakin: 0,4, Tidak Yakin: 0,1 </h4>
<form action="" method="post">
  <table class='table table-bordered'>
    <tr>
      <td class="text-center" width="25"><b>No</b></td>
      <td class="text-center"><b>Pertanyaan</b></td>
      <td class="text-center" width="300"><b>Masukan nilai keyakinan anda disini</b></td>
    </tr>
    <?php
    $no = 1;
    $hasil = mysqli_query($con, "SELECT * FROM gejala ORDER BY id_gejala ASC");
    $rt = mysqli_num_rows($hasil);
    while($row = mysqli_fetch_array($hasil))
    {
    ?>
    <tr>
      <td align='center'><?php echo $no?></td>
      <td>
        <input id="check<?php echo $row['id_gejala']?>" onclick="enabletext('<?php echo $row['id_gejala']?>')" type="hidden"  value="<?php echo $row['kd_gejala']?>" name="gejala<?php echo $no?>">
        Apakah Anda Merasa <?php echo $row['nama_gejala']?> ?</br>
      </td>
      <td>
        <input id="text<?php echo $row['id_gejala']?>" name="cf<?php echo $no?>" type="number" min="0.1" max="1" step="0.01" class="form-control" placeholder="Masukkan nilai 0.1 - 1" >
        <!--select name="nilai2">
          <option value="1">Sangat Yakin</option>
          <option value="0.8">Yakin</option>
          <option value="0.6">Cukup Yakin</option>
          <option value="0.4">Sedikit Yakin</option>
          <option value="0.1">Kurang Yakin</option>
        </select-->
      </td>
      <input type="hidden" name="nama<?php echo $no?>" value="<?php echo $row['nama_gejala']?>" />
    </tr>
    <?php
    $no++;
    }
    ?>

    <script type="text/javascript">
      function enabletext(id) {
        if ($('#check'+id).is(':checked', true)) {
          $('#text'+id).prop('disabled', false);
        } else {
          $('#text'+id).val('');
          $('#text'+id).prop('disabled', true);
        }
      }
    </script>
  </table>
  <div align="center">
    <input type="submit" class="btn btn-info" name="periksa" id="periksa" value="Periksa Konsultasi" />
    <input name="reset" type="reset" class="btn " style="background-color: red; color:white;" value="Reset " />
  </div>
</form>
