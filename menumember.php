<div class="static md:sticky md:top-[104px]">
    <ul class="nav nav-stacked nav-pills" id="navpo">
        <li class="nav-item <?php echo (empty($_GET['r']) || $_GET['r'] == 'homemember') ? 'active' : '' ?>">
            <a class="nav-link" href="?r=homemember"><i data-lucide="home" class="w-5 h-5"></i> Home</a>
        </li>

        <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'gejala' ? 'active' : '' ?>">
            <a class="nav-link" href="?r=gejala"><i data-lucide="book-open" class="w-5 h-5"></i> Information</a>
        </li>

        <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'konsultasi' ? 'active' : '' ?>">
            <a class="nav-link" href="?r=konsultasi"><i data-lucide="clipboard-list" class="w-5 h-5"></i> Konsultasi</a>
        </li>

        <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'bantuan' ? 'active' : '' ?>">
            <a class="nav-link" href="?r=bantuan"><i data-lucide="circle-help" class="w-5 h-5"></i> Bantuan Penggunaan</a>
        </li>

        <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'kirimpesan' ? 'active' : '' ?>">
            <a class="nav-link" href="?r=kirimpesan"><i data-lucide="mail" class="w-5 h-5"></i> Kirim Pesan</a>
        </li>
    </ul>
</div>

<div class="min-w-0">
  <div id="isiadmin">
    <?php
    if (isset($_GET["r"])) {
        $r = $_GET["r"];
        switch ($r) {
            case "homemember":
                include "modules/member/homemember.php";
                break;
            case "gejala":
                include "modules/member/gejala.php";
                break;
            case "bantuan":
                include "modules/member/bantuan.php";
                break;
            case "konsultasi":
                include "modules/konsul/konsultasi.php";
                break;
            case "rule":
                include "modules/konsul/rule.php";
                break;
            case "cetak":
                include "modules/konsul/cetak.php";
                break;
            case "kirimpesan":
                include "modules/pesan/kirimpesan.php";
                break;
            case "hapuspesan":
                include "modules/pesan/hapuspesan.php";
                break;
            case "kotakmasuk":
                include "modules/menuplus/kotakmasuk.php";
                break;
            case "hasilkonsul":
                include "modules/menuplus/hasilkonsul.php";
                break;
            case "editprofil":
                include "modules/menuplus/editprofil.php";
                break;
            case "logout":
                include "logout.php";
                break;
            default:
                include "modules/member/homemember.php";
                break;
        }
    } else {
        include "modules/member/homemember.php";
    }
    ?>
  </div>
</div>
