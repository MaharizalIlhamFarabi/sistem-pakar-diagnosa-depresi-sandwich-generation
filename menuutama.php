<div class="static md:sticky md:top-[104px]">
  <ul class="nav nav-stacked nav-pills" id="navpo">
    <li class="nav-item <?php echo (empty($_GET['r']) || $_GET['r'] == 'home') ? 'active' : '' ?>">
      <a class="nav-link" href="?r=home"><i data-lucide="home" class="w-5 h-5"></i> Home</a>
    </li>
    <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'gejala' ? 'active' : '' ?>">
      <a class="nav-link" href="?r=gejala"><i data-lucide="book-open" class="w-5 h-5"></i> Information</a>
    </li>
    <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'registeruser' ? 'active' : '' ?>">
      <a class="nav-link" href="?r=registeruser"><i data-lucide="user-plus" class="w-5 h-5"></i> Register</a>
    </li>
    <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'loginuser' ? 'active' : '' ?>">
      <a class="nav-link" href="?r=loginuser"><i data-lucide="log-in" class="w-5 h-5"></i> Login</a>
    </li>
    <li class="nav-item <?php echo ($_GET['r'] ?? '') == 'bantuan' ? 'active' : '' ?>">
      <a class="nav-link" href="?r=bantuan"><i data-lucide="circle-help" class="w-5 h-5"></i> Bantuan Penggunaan</a>
    </li>
  </ul>
</div>

<div class="min-w-0">
  <div id="isiadmin">
    <?php
    if (@$_GET["r"] == "home") {
        include "home.php";
    } else if (@$_GET["r"] == "gejala") {
        include "modules/member/gejala.php";
    } else if (@$_GET["r"] == "bantuan") {
        include "modules/member/bantuan.php";
    } else if (@$_GET["r"] == "registeruser") {
        include "modules/member/registeruser.php";
    } else if (@$_GET["r"] == "loginuser") {
        include "modules/member/loginuser.php";
    } else {
        include "home.php";
    }
    ?>
  </div>
</div>
