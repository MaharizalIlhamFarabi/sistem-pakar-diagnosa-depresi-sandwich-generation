<?php session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Sistem Pakar</title>
</head>
<body style="color:#09C">
<div class="backgroundall">
    <div class="container1">
        <div class="dh12">
            <?php include "header.php"; ?>
        </div>

        <div style="margin-left:40px;">
            <b><p style="font-size: 20px;color:#000;"> </p></b>
            <p class="" style="color:#000"> </p>
        </div>
    </div>

    <br>

    <div class="grid">
        <div class="dh3">
            <?php include "menu.php"; ?>
        </div>
    </div>

    <div class="container2" style="margin-top:50px;">
        <!-- Isi konten di sini -->
    </div>

    <div class="container1f" style="background-color:rgb(45, 45, 45)">
        <div class="dh12">
            <?php include "footer.php"; ?>
        </div>
    </div>
</div>
</body>
</html>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
