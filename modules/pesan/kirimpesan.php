<?php
if(isset($_POST["kirim"])){
  include "koneksi.php";
  $pesan = nl2br($_POST["pesan"]);

  $sqlpe = mysqli_query($con, "INSERT INTO pesanm (id_member, id_balas, pesan, status, waktu) VALUES ('$_POST[id_member]', '', '$pesan', 'notyet', NOW())");
  
  if($sqlpe){
    echo "<div align='center' class='alert alert-success'>
      <strong>Pesan Berhasil Dikirim!</strong>
    </div>";
  }else{
    echo "<div align='center' class='alert alert-danger'>
      <strong>Pesan Gagal Dikirim!</strong>
    </div>";
  }
  echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=homemember'>";
}
?>

<?php include "koneksi.php";
$sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
$rm = mysqli_fetch_array($sqlm);
?>

<div class="flex justify-end mb-6">
  <a href='?r=kotakmasuk' class='btn btn-info inline-flex items-center gap-2'><i data-lucide="inbox" class="w-4 h-4"></i> Lihat Kotak Masuk</a>
</div>

<div>
  <span class="eyebrow">Kirim Pesan</span>
  <h1 class="font-display text-[28px] font-semibold text-ink mt-0 mb-4 leading-[1.2] tracking-tight">Kirim pesan ke administrator</h1>
  <div class="cf-scale"></div>
</div>

<p class="mt-6 mb-6 text-[15.5px] leading-relaxed text-ink-soft">
  Ada yang ingin ditanyakan seputar sistem atau hasil konsultasi Anda? Tulis pesan di bawah ini — balasan akan muncul di Kotak Masuk.
</p>

<form name="form1" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="id_member" value="<?php echo "$rm[id_member]"; ?>" />

  <label class="block font-display text-[13.5px] font-semibold text-ink mb-1.5">Pesan Anda</label>
  <textarea name="pesan" id="textareapesan" class="form-control w-full px-4 py-3 text-[15px] rounded-xl min-h-[160px] leading-relaxed" placeholder="Tulis pesan Anda di sini..." required></textarea>

  <div class="mt-6">
    <button name="kirim" type="submit" class="inline-flex items-center gap-2.5 bg-harbor hover:bg-harbor-deep text-white font-display font-semibold text-base rounded-xl px-7 py-3.5 shadow-[0_8px_20px_rgba(53,97,140,0.28)] transition-colors">
      <i data-lucide="send" class="w-5 h-5"></i> Kirim Pesan
    </button>
  </div>
</form>
