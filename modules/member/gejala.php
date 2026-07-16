<?php include "koneksi.php"; ?>

<div>
    <span class="eyebrow">Basis Pengetahuan</span>
    <h1 class="font-display text-[32px] font-semibold text-ink mt-0 mb-6 leading-[1.15] tracking-tight">Jenis dan Gejala Depresi <span class="text-harbor-deep">Sandwich Generation</span></h1>
</div>
<div class="cf-scale mb-7"></div>

<div class="text-[16.5px] leading-[1.75] text-ink-soft mb-7">
    <p class="mb-3">Terdapat tiga jenis Depresi Sandwich Generation, yaitu:</p>
    <ol class="list-decimal pl-5 mb-3 space-y-1">
        <li>Depresi Sandwich Generation (Ringan)</li>
        <li>Depresi Sandwich Generation (Sedang)</li>
        <li>Depresi Sandwich Generation (Berat)</li>
    </ol>
    <p>Di bawah ini merupakan sedikit penjelasan tentang masing-masing jenisnya:</p>
</div>

<div class="space-y-3">
    <?php
    $panels = [
        ["kd" => "K01", "id" => "p1", "label" => "1. Depresi Sandwich Generation Ringan"],
        ["kd" => "K02", "id" => "p2", "label" => "2. Depresi Sandwich Generation Sedang"],
        ["kd" => "K03", "id" => "p3", "label" => "3. Depresi Sandwich Generation Berat"],
    ];

    foreach ($panels as $panel) {
        $sqlp = mysqli_query($con, "select * from penyakit where kd_penyakit='{$panel['kd']}'");
        $rp = mysqli_fetch_array($sqlp);
        ?>
        <div>
            <a class="btn btn-info flex items-center justify-between gap-3 w-full !rounded-xl !py-3.5 !px-5 text-left"
               data-toggle="collapse" href="#<?php echo $panel['id']; ?>" role="button" aria-expanded="false">
                <span><?php echo $panel['label']; ?></span>
                <i data-lucide="chevron-down" class="w-5 h-5 shrink-0"></i>
            </a>
            <div class="collapse" id="<?php echo $panel['id']; ?>">
                <div class="mt-3 p-5 rounded-xl border border-line bg-mist/40">
                    <p class="text-[15px] leading-[1.7] text-ink-soft mb-3" align="justify"><?php echo $rp['keterangan']; ?></p>
                    <p class="text-[15px] leading-[1.7] text-ink-soft mb-4" align="justify">Hal yang dapat dilakukan jika terdiagnosa ini adalah: <?php echo $rp['penanggulangan']; ?></p>
                    <p class="text-[16px] font-semibold text-ink mb-3">Berikut adalah daftar gejalanya:</p>
                    <div class="overflow-hidden rounded-lg border border-line">
                        <table class="table table-hover table-sm table-bordered !mb-0">
                            <thead>
                                <tr id="thpo">
                                    <th>No</th>
                                    <th>Kode Gejala</th>
                                    <th>Nama gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sqlg = mysqli_query($con, "select * from gejala where kd_penyakit='{$panel['kd']}'");
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
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
