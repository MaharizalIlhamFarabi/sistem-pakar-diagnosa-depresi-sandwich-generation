<?php
if (!empty($_SESSION["usermbr"]) && !empty($_SESSION["passmbr"])) {
    include "koneksi.php";
    $sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='$_SESSION[usermbr]'");
    $rm = mysqli_fetch_array($sqlm);

    include "menumember.php";
} else {
    include "menuutama.php";
}
?>
