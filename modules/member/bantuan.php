<div>
    <span class="eyebrow">Bantuan Penggunaan</span>
    <h1 class="font-display text-[30px] font-semibold text-ink mt-0 mb-4 leading-[1.15] tracking-tight">Petunjuk Penggunaan Sistem Pakar</h1>
    <div class="cf-scale"></div>
</div>

<p class="mt-6 mb-7 text-[16px] leading-relaxed text-ink-soft" align="justify">
    Bagi Anda yang baru menggunakan Sistem Pakar ini, terdapat beberapa menu yang dapat Anda pilih. Berikut penjelasan tiap menu beserta fungsinya.
</p>

<?php
$panduan = [
    ["no" => 1, "icon" => "book-open",      "judul" => "Information",  "desc" => "Berisi penjelasan tentang jenis dan gejala Depresi Sandwich Generation."],
    ["no" => 2, "icon" => "user-plus",      "judul" => "Register",     "desc" => "Form untuk melakukan registrasi jika Anda ingin melakukan konsultasi."],
    ["no" => 3, "icon" => "log-in",         "judul" => "Login",        "desc" => "Bagi Anda yang sudah registrasi, masuk di halaman ini untuk mulai berkonsultasi."],
    ["no" => 5, "icon" => "mail",           "judul" => "Kirim Pesan",  "desc" => "Kirim pesan kepada administrator bila ada yang ingin ditanyakan seputar sistem."],
    ["no" => 6, "icon" => "user-cog",       "judul" => "Ubah Profil",  "desc" => "Melalui menu dropdown di kanan atas, Anda dapat mengubah data diri Anda."],
    ["no" => 7, "icon" => "file-check-2",   "judul" => "Hasil Konsul", "desc" => "Melihat riwayat konsultasi yang pernah Anda lakukan selama ini."],
    ["no" => 8, "icon" => "inbox",          "judul" => "Inbox",        "desc" => "Melihat balasan pesan dari administrator."],
    ["no" => 9, "icon" => "log-out",        "judul" => "Logout",       "desc" => "Digunakan untuk keluar dari sistem."],
];
?>

<!-- Konsultasi — fitur inti, disorot penuh -->
<div class="rounded-2xl border border-harbor/30 bg-harbor-tint/40 p-6 mb-5">
    <div class="flex items-start gap-4">
        <span class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-[linear-gradient(135deg,theme(colors.harbor),theme(colors.ember))] text-white shadow-[0_6px_16px_rgba(53,97,140,0.28)]">
            <i data-lucide="clipboard-list" class="w-6 h-6"></i>
        </span>
        <div class="min-w-0">
            <div class="flex items-center gap-2.5 mb-1.5">
                <span class="font-mono text-[12px] font-semibold text-harbor">04</span>
                <h2 class="font-display text-[19px] font-semibold text-ink m-0">Konsultasi</h2>
                <span class="font-mono text-[10px] uppercase tracking-[1px] text-white bg-harbor rounded-full px-2 py-0.5">Menu Utama</span>
            </div>
            <p class="text-[15px] leading-relaxed text-ink-soft m-0" align="justify">
                Menu untuk melakukan konsultasi terhadap Depresi Sandwich Generation yang Anda alami. Anda akan menjawab tiap pertanyaan gejala dengan mengisi <span class="font-semibold text-ink">tingkat keyakinan</span> dari <span class="font-mono text-harbor">0</span> sampai <span class="font-mono text-ember">1</span>, sesuai seberapa besar gejala yang Anda rasakan.
            </p>
        </div>
    </div>
</div>

<!-- Menu lainnya -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <?php foreach ($panduan as $item): ?>
    <div class="flex items-start gap-3.5 rounded-xl border border-line bg-white p-4 hover:border-harbor/40 hover:shadow-[0_8px_20px_rgba(15,27,39,0.06)] transition-all">
        <span class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0 bg-harbor-tint">
            <i data-lucide="<?php echo $item['icon']; ?>" class="w-5 h-5 text-harbor"></i>
        </span>
        <div class="min-w-0">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-mono text-[11px] font-semibold text-harbor"><?php echo str_pad($item['no'], 2, '0', STR_PAD_LEFT); ?></span>
                <h3 class="font-display text-[15.5px] font-semibold text-ink m-0"><?php echo $item['judul']; ?></h3>
            </div>
            <p class="text-[13.5px] leading-relaxed text-ink-soft m-0"><?php echo $item['desc']; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
