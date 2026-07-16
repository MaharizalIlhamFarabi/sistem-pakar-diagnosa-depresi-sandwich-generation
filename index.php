<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="images/icon.png" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="css/tailwind.css" />
    <title>Sistem Pakar</title>
</head>
<body>
<div class="min-h-screen grid grid-rows-[auto_1fr_auto] bg-[radial-gradient(circle_at_18%_-12%,#e2eaf0_0%,theme(colors.paper)_46%)] text-ink">
    <?php include "header.php"; ?>

    <div class="grid grid-cols-1 md:grid-cols-[260px_1fr] gap-7 max-w-[1280px] w-full mx-auto p-5 md:p-8 md:pb-12 items-start box-border">
        <?php include "menu.php"; ?>
    </div>

    <footer class="bg-deep">
        <div class="cf-scale cf-scale--thin"></div>
        <div class="max-w-[880px] mx-auto px-8 py-10 flex justify-between flex-wrap gap-10 box-border">
            <?php include "footer.php"; ?>
        </div>
    </footer>
</div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/lucide.js"></script>
<script>
  function renderIcons() { if (window.lucide) lucide.createIcons(); }
  renderIcons();
  document.addEventListener('DOMContentLoaded', renderIcons);
</script>
