<?php
include "koneksi.php";
$mysqli = new mysqli(getenv("DB_HOST") ?: "localhost", "root", "", "cf_depresi"); // host dari env agar jalan di Docker & lokal

if (isset($_POST["edit"])) {
    $bulan = $_POST['bln'];
    $tahun = $_POST['thn'];

    $jmltgl = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);

    $alamat = nl2br($_POST["alamat"]);

    $maxdate = date($_POST['thn'] . '-' . $_POST['bln'] . '-' . $jmltgl);

    $tgl = $_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];

    if (!empty($_POST['nama']) && !empty($_POST['jk']) && !empty($alamat) && !empty($tgl) && !empty($_POST['username']) && !empty($_POST['password'])) {

        if ($tgl <= $maxdate) {
            $sqlm = "UPDATE member SET nama=?, jk=?, alamat=?, tgl_lahir=?, username=?, password=? WHERE id_member=?";
            $stmt = $mysqli->prepare($sqlm);

            if ($stmt) {
                $stmt->bind_param("ssssssi", $_POST['nama'], $_POST['jk'], $alamat, $tgl, $_POST['username'], $_POST['password'], $_POST['id_member']);
                $stmt->execute();
                $stmt->close();

                echo "<div align='center' class='alert alert-success'>
                            <strong>Update data Berhasil!
                              </div>";
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=homemember'>";
            } else {
                echo "<div align='center' class='alert alert-danger'>
                            <strong>Update data Gagal!
                              </div>";
                echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=editprofil'>";
            }
        } else {
            echo "<div align='center' class='alert alert-danger'>
                    <strong><span class='glyphicon glyphicon-info-sign'></span>Tanggal Input tidak valid!
                      </div>";
            echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=editprofil'>";
        }
    } else if (empty($_POST['nama']) || empty($_POST['jk']) || empty($alamat) || empty($tgl) || empty($_POST['username']) || empty($_POST['password'])) {
        echo "<div align='center' class='alert alert-danger'>
              <strong>Silakan Isi Semua Data!
                </div>";
    }
}

$sqlm = "SELECT * FROM member WHERE username=?";
$stmt = $mysqli->prepare($sqlm);

if ($stmt) {
    $stmt->bind_param("s", $_SESSION['usermbr']);
    $stmt->execute();
    $result = $stmt->get_result();
    $rm = $result->fetch_assoc();

    $stmt->close();

    $tgl = substr($rm["tgl_lahir"], 8, 2);
    $bln = substr($rm["tgl_lahir"], 5, 2);
    $thn = substr($rm["tgl_lahir"], 0, 4);
}
?>

<div>
    <span class="eyebrow">Edit Profil</span>
    <h1 class="font-display text-[28px] font-semibold text-ink mt-0 mb-4 leading-[1.2] tracking-tight">Ubah data diri Anda</h1>
    <div class="cf-scale"></div>
</div>

<form name="form1" method="post" action="" enctype="multipart/form-data" class="mt-7">
    <input type="hidden" name="id_member" value="<?php echo $rm["id_member"]; ?>">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <label class="block font-display text-[13.5px] font-semibold text-ink mb-1.5">Username</label>
            <div class="relative">
                <i data-lucide="user" class="w-[18px] h-[18px] text-harbor absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" class="form-control w-full pl-11 pr-4 py-3 text-[15px] rounded-lg" name="username" value="<?php echo $rm["username"]; ?>">
            </div>
        </div>

        <div>
            <label class="block font-display text-[13.5px] font-semibold text-ink mb-1.5">Password</label>
            <div class="relative">
                <i data-lucide="lock" class="w-[18px] h-[18px] text-harbor absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" class="form-control w-full pl-11 pr-4 py-3 text-[15px] rounded-lg" name="password" value="<?php echo $rm["password"]; ?>">
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block font-display text-[13.5px] font-semibold text-ink mb-1.5">Nama Lengkap</label>
            <div class="relative">
                <i data-lucide="pencil" class="w-[18px] h-[18px] text-harbor absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                <input type="text" class="form-control w-full pl-11 pr-4 py-3 text-[15px] rounded-lg" name="nama" value="<?php echo $rm["nama"]; ?>">
            </div>
        </div>

        <div class="md:col-span-2">
            <label class="block font-display text-[13.5px] font-semibold text-ink mb-1.5">Alamat</label>
            <div class="relative">
                <i data-lucide="map-pin" class="w-[18px] h-[18px] text-harbor absolute left-3.5 top-3.5"></i>
                <textarea class="form-control w-full pl-11 pr-4 py-3 text-[15px] rounded-lg min-h-[90px]" name="alamat"><?php echo $rm["alamat"]; ?></textarea>
            </div>
        </div>
    </div>

    <?php
    if ($rm["jk"] == "pria") {
        $p = "checked";
        $w = "";
    } else if ($rm["jk"] == "wanita") {
        $p = "";
        $w = "checked";
    } else {
        $p = "";
        $w = "";
    }
    ?>
    <div class="mt-5">
        <label class="block font-display text-[13.5px] font-semibold text-ink mb-2">Jenis Kelamin</label>
        <div class="flex gap-3">
            <label class="flex items-center gap-2.5 rounded-lg border border-line bg-mist/40 px-4 py-2.5 cursor-pointer hover:border-harbor/50">
                <input name="jk" type="radio" value="pria" <?php echo $p; ?> class="accent-harbor w-4 h-4">
                <span class="text-[14.5px] text-ink">Pria</span>
            </label>
            <label class="flex items-center gap-2.5 rounded-lg border border-line bg-mist/40 px-4 py-2.5 cursor-pointer hover:border-harbor/50">
                <input name="jk" type="radio" value="wanita" <?php echo $w; ?> class="accent-harbor w-4 h-4">
                <span class="text-[14.5px] text-ink">Wanita</span>
            </label>
        </div>
    </div>

    <div class="mt-5">
        <label class="block font-display text-[13.5px] font-semibold text-ink mb-2">Tanggal Lahir</label>
        <div class="flex flex-wrap gap-3">
            <select name="tgl" class="form-control px-3 py-3 text-[15px] rounded-lg cursor-pointer">
                <?php
                for ($j = 1; $j <= 31; $j++) {
                    $j_disp = $j < 10 ? '0' . $j : $j;
                    $sel = ($tgl == $j_disp) ? " selected" : "";
                    echo "<option value='$j_disp' $sel>$j</option>";
                }
                ?>
            </select>
            <select name="bln" class="form-control px-3 py-3 text-[15px] rounded-lg cursor-pointer">
                <?php
                $bulans = array(
                    '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
                    '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
                    '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                );
                foreach ($bulans as $key => $value) {
                    $sel = ($bln == $key) ? " selected" : "";
                    echo "<option value='$key' $sel>$value</option>";
                }
                ?>
            </select>
            <select name="thn" class="form-control px-3 py-3 text-[15px] rounded-lg cursor-pointer">
                <?php
                $now = date('Y');
                for ($i = 1900; $i <= $now; $i++) {
                    $sel = ($thn == $i) ? " selected " : "";
                    echo "<option value='$i'$sel>$i</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="flex items-center gap-3 mt-8">
        <button name="edit" type="submit" class="inline-flex items-center gap-2.5 bg-harbor hover:bg-harbor-deep text-white font-display font-semibold text-base rounded-xl px-7 py-3.5 shadow-[0_8px_20px_rgba(53,97,140,0.28)] transition-colors">
            <i data-lucide="save" class="w-5 h-5"></i> Ubah Data
        </button>
        <a href='?r=homemember' class='inline-flex items-center gap-2.5 bg-white border border-line text-ink-soft font-display font-semibold text-base rounded-xl px-6 py-3.5 hover:bg-mist transition-colors'>
            <i data-lucide="x" class="w-5 h-5"></i> Batal
        </a>
    </div>
</form>
