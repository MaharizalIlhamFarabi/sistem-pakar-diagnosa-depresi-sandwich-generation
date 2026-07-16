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

<div class="flex justify-end mb-6">
  <a href='?r=hasilkonsul' class='btn btn-info inline-flex items-center gap-2'><i data-lucide="history" class="w-4 h-4"></i> Lihat Hasil Konsul Sebelumnya</a>
</div>

<div class="mb-2">
  <span class="eyebrow">Konsultasi</span>
  <h1 class="font-display text-[28px] font-semibold text-ink mt-0 mb-4 leading-[1.2] tracking-tight">
    Jawab tingkat keyakinan Anda pada tiap gejala berikut
  </h1>
  <div class="cf-scale"></div>
</div>

<!-- Panduan rentang nilai keyakinan -->
<div class="mt-6 mb-7 rounded-2xl border border-line bg-mist/40 p-5">
  <p class="font-display text-[17px] font-semibold text-ink m-0 mb-3">Rentang nilai keyakinan</p>
  <div class="flex flex-wrap gap-2">
    <span class="inline-flex items-center gap-1.5 rounded-full bg-white border border-line px-3 py-1.5 text-[13px] text-ink"><span class="font-mono font-semibold text-ember">1</span> Sangat Yakin</span>
    <span class="inline-flex items-center gap-1.5 rounded-full bg-white border border-line px-3 py-1.5 text-[13px] text-ink"><span class="font-mono font-semibold text-ember">0,8</span> Yakin</span>
    <span class="inline-flex items-center gap-1.5 rounded-full bg-white border border-line px-3 py-1.5 text-[13px] text-ink"><span class="font-mono font-semibold text-harbor">0,6</span> Cukup Yakin</span>
    <span class="inline-flex items-center gap-1.5 rounded-full bg-white border border-line px-3 py-1.5 text-[13px] text-ink"><span class="font-mono font-semibold text-harbor">0,4</span> Sedikit Yakin</span>
    <span class="inline-flex items-center gap-1.5 rounded-full bg-white border border-line px-3 py-1.5 text-[13px] text-ink"><span class="font-mono font-semibold text-haze">0,1</span> Tidak Yakin</span>
  </div>
</div>

<form action="" method="post">
  <div class="overflow-hidden rounded-2xl border border-line shadow-[0_10px_30px_rgba(15,27,39,0.06)]">
    <table class="w-full border-collapse">
      <thead>
        <tr class="bg-harbor text-white font-display">
          <th class="text-center font-semibold uppercase tracking-wide text-[13px] px-5 py-4 w-16">No</th>
          <th class="text-left font-semibold uppercase tracking-wide text-[13px] px-5 py-4">Pertanyaan Gejala</th>
          <th class="text-center font-semibold uppercase tracking-wide text-[13px] px-5 py-4 w-[320px]">Nilai Keyakinan Anda</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $hasil = mysqli_query($con, "SELECT * FROM gejala ORDER BY id_gejala ASC");
        $rt = mysqli_num_rows($hasil);
        while($row = mysqli_fetch_array($hasil))
        {
        ?>
        <tr class="border-t border-line even:bg-mist/25 hover:bg-harbor-tint/40 transition-colors align-middle">
          <td class="px-5 py-5 text-center">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-harbor-tint font-mono text-sm font-semibold text-harbor-deep"><?php echo $no?></span>
          </td>
          <td class="px-5 py-5 text-[17px] leading-relaxed text-ink">
            <input type="hidden" value="<?php echo $row['kd_gejala']?>" name="gejala<?php echo $no?>">
            Apakah Anda merasa <span class="font-semibold text-ink"><?php echo $row['nama_gejala']?></span>?
          </td>
          <td class="px-5 py-5">
            <?php $cf_default = ""; // TESTING: nilai default terpilih agar form cepat diisi. Set "" untuk produksi. ?>
            <select name="cf<?php echo $no?>" class="form-control w-full px-4 py-3 text-[15px] rounded-lg cursor-pointer">
              <option value="" <?php echo $cf_default === "" ? "selected" : ""; ?>>-- Pilih Nilai Keyakinan --</option>
              <option value="1" <?php echo $cf_default === "1" ? "selected" : ""; ?>>Sangat Yakin (1)</option>
              <option value="0.8" <?php echo $cf_default === "0.8" ? "selected" : ""; ?>>Yakin (0,8)</option>
              <option value="0.6" <?php echo $cf_default === "0.6" ? "selected" : ""; ?>>Cukup Yakin (0,6)</option>
              <option value="0.4" <?php echo $cf_default === "0.4" ? "selected" : ""; ?>>Sedikit Yakin (0,4)</option>
              <option value="0.1" <?php echo $cf_default === "0.1" ? "selected" : ""; ?>>Tidak Yakin (0,1)</option>
            </select>
          </td>
          <input type="hidden" name="nama<?php echo $no?>" value="<?php echo $row['nama_gejala']?>" />
        </tr>
        <?php
        $no++;
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="flex items-center justify-center gap-4 mt-8">
    <button type="submit" name="periksa" id="periksa" class="inline-flex items-center gap-2.5 bg-harbor hover:bg-harbor-deep text-white font-display font-semibold text-base rounded-xl px-8 py-4 shadow-[0_8px_20px_rgba(53,97,140,0.28)] transition-colors">
      <i data-lucide="stethoscope" class="w-5 h-5"></i> Periksa Konsultasi
    </button>
    <button type="reset" class="inline-flex items-center gap-2.5 bg-white border border-line text-ink-soft font-display font-semibold text-base rounded-xl px-7 py-4 hover:bg-mist transition-colors">
      <i data-lucide="rotate-ccw" class="w-5 h-5"></i> Reset
    </button>
  </div>
</form>
