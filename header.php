<header class="sticky top-0 z-[200] bg-deep shadow-[0_4px_20px_rgba(0,0,0,0.22)]">
    <div class="max-w-[1280px] mx-auto px-8 py-5 flex items-center justify-between gap-5 flex-wrap box-border">
        <a href="?r=home" class="flex flex-col no-underline">
            <span class="font-display text-[22px] font-semibold text-white leading-tight tracking-tight">Sistem Pakar</span>
            <span class="font-mono text-[10.5px] text-[#8ba3b5] tracking-[1px] uppercase">Depresi Sandwich Generation &middot; Certainty Factor</span>
        </a>

        <?php
        include "koneksi.php";

        if (!empty($_SESSION["usermbr"]) && !empty($_SESSION["passmbr"])) {
            $sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
            $rm = mysqli_fetch_array($sqlm);

            $sqlc = mysqli_query($con, "SELECT * FROM balas_pesan WHERE id_member='$rm[id_member]' AND status='notyet'");
            $rc = mysqli_num_rows($sqlc);

            echo "<div class='dropdown relative p-0'>
                <a id='a-memberkananatas' href='#' class='dropdown-toggle flex items-center gap-3 text-white font-display font-semibold text-[15px] pl-2 pr-5 py-2 rounded-full bg-white/10 border border-white/20 hover:bg-white/20' data-toggle='dropdown'>
                    <span class='w-9 h-9 rounded-full bg-white/15 flex items-center justify-center shrink-0'><i data-lucide='user' class='w-[18px] h-[18px]'></i></span>
                    $rm[nama]
                    <i data-lucide='chevron-down' class='w-[18px] h-[18px] opacity-70'></i>
                </a>
                <ul id='ul-memberkananatas' class='dropdown-menu right-0 left-auto mt-2 rounded-xl border border-line shadow-[0_16px_36px_rgba(27,36,48,0.22)] p-0 min-w-[264px] overflow-hidden'>
                    <li class='flex items-center gap-3 px-4 py-3.5 bg-mist/60 border-b border-line'>
                        <span class='w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-[linear-gradient(135deg,theme(colors.harbor),theme(colors.ember))] text-white'><i data-lucide='user' class='w-5 h-5'></i></span>
                        <span class='flex flex-col min-w-0'>
                            <span class='font-display font-semibold text-[14px] text-ink leading-tight truncate'>$rm[nama]</span>
                            <span class='font-mono text-[10px] uppercase tracking-[1px] text-ink-soft mt-0.5'>Member</span>
                        </span>
                    </li>
                    <li class='p-1.5'>
                        <a href='?r=editprofil'><span class='dd-ic'><i data-lucide='user-cog' class='w-4 h-4 text-harbor'></i></span> Edit Profil</a>
                        <a href='?r=hasilkonsul'><span class='dd-ic'><i data-lucide='file-check-2' class='w-4 h-4 text-harbor'></i></span> Hasil Konsul</a>
                        <a href='?r=kotakmasuk'><span class='dd-ic'><i data-lucide='inbox' class='w-4 h-4 text-harbor'></i></span> Inbox" . ($rc > 0 ? " <span class='ml-auto inline-flex items-center justify-center min-w-[22px] h-[22px] px-1.5 rounded-full bg-ember text-white font-display font-semibold text-[11px]'>$rc</span>" : "") . "</a>
                    </li>
                    <li class='p-1.5 border-t border-line'>
                        <a class='dd-logout' href='?r=logout'><span class='dd-ic dd-ic--warn'><i data-lucide='log-out' class='w-4 h-4 text-ember'></i></span> Logout</a>
                    </li>
                </ul>
            </div>";
        }
        ?>
    </div>
    <div class="cf-scale cf-scale--thin"></div>
</header>
