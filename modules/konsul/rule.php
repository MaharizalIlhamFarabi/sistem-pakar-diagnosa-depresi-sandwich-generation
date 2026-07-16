<?php
include "koneksi.php";

$sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
$rm = mysqli_fetch_array($sqlm);
$idmember = $rm['id_member'];

$no_konsul = $_GET['no_konsul'];
?>

<div>
    <span class="eyebrow">Hasil Konsultasi</span>
    <h1 class="font-display text-[28px] font-semibold text-ink mt-0 mb-4 leading-[1.2] tracking-tight">Ringkasan diagnosa Anda</h1>
    <div class="cf-scale"></div>
</div>

<?php
$strsqlku = "SELECT * FROM konsultasi WHERE id_member = $rm[id_member] AND no_konsul = $no_konsul";
$hasil = mysqli_query($con, $strsqlku);
$no = 1;
?>

<div class="mt-10 mb-8">
    <h2 class="font-display text-[16px] font-semibold text-ink mb-4 flex items-center gap-2"><i data-lucide="clipboard-check" class="w-5 h-5 text-harbor"></i> Gejala yang Anda laporkan</h2>
    <div class="overflow-hidden rounded-2xl border border-line shadow-[0_10px_30px_rgba(15,27,39,0.06)]">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="bg-harbor text-white font-display">
                    <th class="text-center font-semibold uppercase tracking-wide text-[12px] px-4 py-3 w-12">No</th>
                    <th class="text-center font-semibold uppercase tracking-wide text-[12px] px-4 py-3 w-20">Kode</th>
                    <th class="font-semibold uppercase tracking-wide text-[12px] px-4 py-3">Gejala</th>
                    <th class="text-center font-semibold uppercase tracking-wide text-[12px] px-4 py-3 w-36">Nilai Kepastian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($hasil)) {
                    $strsqlku2 = mysqli_query($con, "SELECT * FROM gejala WHERE kd_gejala='$row[kd_gejala]'");
                    while ($row2 = mysqli_fetch_array($strsqlku2)) {
                        echo "<tr class='border-t border-line even:bg-mist/25'>";
                        echo "<td class='px-4 py-3 text-center font-mono text-[13px] text-ink-soft'>$no</td>";
                        echo "<td class='px-4 py-3 text-center font-mono text-[13px] font-semibold text-harbor'>$row2[kd_gejala]</td>";
                        echo "<td class='px-4 py-3 text-[14.5px] text-ink'>$row2[nama_gejala]</td>";
                        echo "<td class='px-4 py-3 text-center'><span class='inline-flex items-center justify-center min-w-[42px] rounded-full bg-harbor-tint px-2.5 py-1 font-mono text-[13px] font-semibold text-harbor-deep'>$row[cf]</span></td>";
                        echo "</tr>";
                        $no++;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// ============================================================
//  PERHITUNGAN CERTAINTY FACTOR — Metode per-gejala (Opsi A)
//  Tiap penyakit dinilai HANYA dari gejalanya sendiri (gejala.kd_penyakit).
//  Tiap gejala dihitung sekali:  CF_gejala = CF_user × CF_pakar
//  lalu digabung:                CFgab = CFlama + CFbaru × (1 − CFlama)
//  Diagnosa = penyakit dengan CF gabungan tertinggi.
// ============================================================

$cfPenyakit = [];   // kd_penyakit => cf gabungan
$rincian    = [];   // kd_penyakit => baris rincian (untuk detil proses)

$sqlpAll = mysqli_query($con, "SELECT kd_penyakit FROM penyakit ORDER BY kd_penyakit ASC");
while ($pk = mysqli_fetch_array($sqlpAll)) {
    $kd = $pk['kd_penyakit'];
    $q = mysqli_query($con, "SELECT g.kd_gejala, g.cf_pakar, k.cf AS cf_user
                             FROM konsultasi k
                             JOIN gejala g ON k.kd_gejala = g.kd_gejala
                             WHERE k.no_konsul = '$no_konsul' AND k.id_member = '$idmember'
                               AND g.kd_penyakit = '$kd'
                             ORDER BY g.kd_gejala ASC");
    $cf = 0;
    while ($g = mysqli_fetch_array($q)) {
        $cfGejala = $g['cf_user'] * $g['cf_pakar'];
        $cfLama   = $cf;
        $cf       = $cfLama + $cfGejala * (1 - $cfLama);
        $rincian[$kd][] = [
            'kode'  => $g['kd_gejala'],
            'user'  => (float) $g['cf_user'],
            'pakar' => (float) $g['cf_pakar'],
            'gejala'=> $cfGejala,
            'lama'  => $cfLama,
            'gab'   => $cf,
        ];
    }
    $cfPenyakit[$kd] = $cf;
}

// Diagnosa = CF tertinggi
$kd_max = '';
$htotal = 0;
foreach ($cfPenyakit as $kd => $val) {
    if ($val > $htotal) { $htotal = $val; $kd_max = $kd; }
}
$hakhir = number_format($htotal * 100, 2, '.', '');

// Simpan hasil konsultasi
$cfK01 = number_format($cfPenyakit['K01'] ?? 0, 3, '.', '');
$cfK02 = number_format($cfPenyakit['K02'] ?? 0, 3, '.', '');
$cfK03 = number_format($cfPenyakit['K03'] ?? 0, 3, '.', '');
mysqli_query($con, "INSERT INTO hasil_konsultasi (no_konsul,id_member,kd_penyakit,cf1,cf2,cf3,cf4,max,waktu)
                    VALUES ('$no_konsul','$idmember','$kd_max','$cfK01','$cfK02','$cfK03','0','$hakhir',NOW())");

// Info tingkat
$tingkatMap  = ['K01' => 'Ringan', 'K02' => 'Sedang', 'K03' => 'Berat'];
$namaTingkat = $tingkatMap[$kd_max] ?? '';
$accent = ($kd_max === 'K01') ? 'text-harbor' : 'text-ember';
$band   = ($kd_max === 'K01') ? 'bg-harbor-tint' : 'bg-ember-tint';

$ket = ''; $penanggulangan = '';
if ($kd_max !== '') {
    $rpen = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM penyakit WHERE kd_penyakit='$kd_max'"));
    $ket = $rpen['keterangan'];
    $penanggulangan = $rpen['penanggulangan'];
}

// ---- Kartu hasil (hero) ----
if ($htotal <= 0 || $kd_max === '') {
    echo "<div class='rounded-2xl border border-line bg-mist/40 p-8 text-center'>
            <span class='inline-flex w-14 h-14 rounded-full bg-harbor-tint items-center justify-center mb-4'><i data-lucide='shield-check' class='w-7 h-7 text-harbor'></i></span>
            <h2 class='font-display text-[22px] font-semibold text-ink m-0 mb-2'>Tidak terindikasi</h2>
            <p class='text-[15px] leading-relaxed text-ink-soft max-w-[520px] mx-auto m-0'>Dari jawaban Anda, sistem tidak menemukan indikasi Depresi Sandwich Generation. Tetap jaga kesehatan fisik dan mental Anda.</p>
          </div>";
} else {
    $pct = (float) $hakhir;
    echo "<div class='overflow-hidden rounded-2xl border border-line shadow-[0_16px_40px_rgba(15,27,39,0.08)]'>
        <div class='$band px-7 pt-6 pb-7'>
            <span class='eyebrow'>Kesimpulan</span>
            <div class='flex flex-wrap items-end justify-between gap-4'>
                <div>
                    <span class='block font-mono text-[11px] uppercase tracking-[1.5px] text-ink-soft mb-2'>Depresi Sandwich Generation</span>
                    <h2 class='font-display text-[30px] font-semibold text-ink m-0 leading-none'>Tingkat $namaTingkat</h2>
                </div>
                <div class='text-right'>
                    <div class='font-mono text-[40px] font-semibold leading-none $accent'>$hakhir<span class='text-[22px]'>%</span></div>
                    <span class='font-mono text-[11px] uppercase tracking-[1.5px] text-ink-soft'>Tingkat Kepastian</span>
                </div>
            </div>
            <div class='relative mt-5'>
                <div class='cf-scale'></div>
                <div class='absolute -top-[4px] w-[3px] h-[15px] bg-ink rounded-full shadow-[0_0_0_2px_white]' style='left:$pct%;'></div>
            </div>
            <div class='cf-legend'><span>&minus;1 &middot; tidak yakin</span><span>yakin &middot; +1</span></div>
        </div>
        <div class='p-7'>
            <p class='text-[16px] leading-relaxed text-ink m-0 mb-4'>Dari hasil di atas, Anda kemungkinan terindikasi <span class='font-semibold'>Depresi Sandwich Generation Tingkat $namaTingkat</span> dengan tingkat kepastian <span class='font-semibold $accent'>$hakhir%</span>.</p>
            <p class='text-[15.5px] leading-relaxed text-ink-soft m-0 mb-5' align='justify'>$ket</p>
            <div class='rounded-xl border border-line bg-mist/40 p-5 mb-6'>
                <p class='font-display text-[14px] font-semibold text-ink m-0 mb-2 flex items-center gap-2'><i data-lucide='sparkles' class='w-[18px] h-[18px] text-ember'></i> Yang dapat Anda lakukan</p>
                <p class='text-[14.5px] leading-relaxed text-ink-soft m-0'>$penanggulangan</p>
            </div>
            <a href='cetak.php?&no_konsul=$no_konsul' target='_blank' class='inline-flex items-center gap-2.5 bg-harbor hover:bg-harbor-deep text-white font-display font-semibold text-[15px] rounded-xl px-6 py-3.5 shadow-[0_8px_20px_rgba(53,97,140,0.28)] transition-colors'><i data-lucide='printer' class='w-5 h-5'></i> Cetak Hasil</a>
        </div>
    </div>";
}
?>

<!-- Detil proses perhitungan -->
<div class="flex justify-center mt-7 mb-2">
    <a class="inline-flex items-center gap-2.5 bg-white border border-line text-ink-soft font-display font-semibold text-[14.5px] rounded-xl px-6 py-3 hover:bg-mist transition-colors" data-toggle="collapse" href="#p2" role="button" aria-expanded="false">
        <i data-lucide="function-square" class="w-[18px] h-[18px] text-harbor"></i> Lihat Detil Proses Perhitungan
    </a>
</div>
<div class="collapse multi-collapse" id="p2">
    <div class="rounded-2xl border border-line bg-mist/30 p-6 mt-3">
        <p class="text-[13px] text-ink-soft mb-4">CF gejala = nilai keyakinan Anda × bobot pakar. Tiap penyakit dinilai dari gejalanya sendiri, lalu digabung dengan rumus <span class="font-mono">CFlama + CFbaru × (1 − CFlama)</span>.</p>
        <?php
        foreach ($cfPenyakit as $kd => $val) {
            $nm = $tingkatMap[$kd] ?? $kd;
            $juara = ($kd === $kd_max) ? " <span class='font-mono text-[10px] uppercase tracking-[1px] text-white bg-harbor rounded-full px-2 py-0.5 align-middle'>Tertinggi</span>" : "";
            echo "<h3 class='font-display text-[15px] font-semibold text-ink mt-5 mb-3 flex items-center gap-2'><i data-lucide='binary' class='w-[18px] h-[18px] text-harbor'></i> $kd — Tingkat $nm$juara</h3>";
            echo "<div class='proc-panel'>";
            if (!empty($rincian[$kd])) {
                foreach ($rincian[$kd] as $r) {
                    $cfg  = number_format($r['gejala'], 3, '.', '');
                    $lama = number_format($r['lama'], 3, '.', '');
                    $gab  = number_format($r['gab'], 3, '.', '');
                    echo "{$r['kode']}: CF = {$r['user']} &times; {$r['pakar']} = $cfg &nbsp;&rarr;&nbsp; gabung: $lama + $cfg &middot; (1&minus;$lama) = <b>$gab</b><br>";
                }
                echo "<br>CF akhir $kd = <b>" . number_format($val, 3, '.', '') . "</b> (" . number_format($val * 100, 2, '.', '') . "%)";
            } else {
                echo "Tidak ada gejala kelompok $kd yang Anda jawab.";
            }
            echo "</div>";
        }
        ?>
        <p class="mt-5 text-[14px] text-ink-soft">Diagnosa diambil dari CF tertinggi:
            <span class="font-semibold text-ink"><?php echo $kd_max ? "$kd_max &middot; Tingkat $namaTingkat = $hakhir%" : 'tidak terindikasi'; ?></span>
        </p>
    </div>
</div>

<!-- Catatan -->
<div class="flex items-start gap-3.5 rounded-2xl border border-ember/30 bg-ember-tint/40 p-5 mt-8">
    <span class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-ember-tint"><i data-lucide="heart-pulse" class="w-5 h-5 text-ember"></i></span>
    <div>
        <p class="font-display text-[14px] font-semibold text-ink m-0 mb-1">Hasil ini bukan diagnosis akhir</p>
        <p class="text-[14px] leading-relaxed text-ink-soft m-0">Untuk memahami lebih lanjut hasil diagnosa Anda, silakan hubungi psikolog atau dokter kejiwaan terpercaya.</p>
    </div>
</div>
