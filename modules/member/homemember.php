<?php
include "koneksi.php";
$sqlm = mysqli_query($con, "SELECT * FROM member WHERE username='" . $_SESSION["usermbr"] . "'");
$rm = mysqli_fetch_array($sqlm);
$nama = $rm['nama'];
?>

<div>
    <span class="eyebrow">Selamat datang, <?php echo htmlspecialchars($nama); ?></span>
    <h1 class="font-display text-[32px] font-semibold text-ink mt-0 mb-6 leading-[1.15] tracking-tight">Sistem Pakar &mdash; Diagnosa Depresi <span class="text-harbor-deep">Sandwich Generation</span></h1>
</div>
<div class="mb-7">
    <div class="cf-scale"></div>
    <div class="cf-legend"><span>&minus;1 &middot; tidak yakin</span><span>tingkat keyakinan</span><span>yakin &middot; +1</span></div>
</div>

<div class="text-[16.5px] leading-[1.75] text-ink-soft">
<p class="mb-[18px] text-left first-letter:font-display first-letter:text-[52px] first-letter:font-semibold first-letter:text-ember first-letter:float-left first-letter:leading-[0.8] first-letter:pr-2.5 first-letter:pt-1" align="justify">Sistem pakar merupakan cabang dari Artificial Intelligence (AI) yang cukup tua karena sistem ini mulai dikembangkan pada pertengahan 1960-an. Sistem pakar yang muncul pertama kali adalah General-purpose problem solver (GPS) yang dikembangkan oleh Newell dan Simon. Istilah sistem pakar berasal dari istilah Knowledge-based expert system. Istilah ini muncul karena untuk pemecahan masalah, sistem pakar menggunakan pengetahuan seorang pakar yang dimasukkan ke dalam komputer (Sutojo, T., Edy Mulyanto, dan Vincent Suhartono, 2011 : 160).</p>
<p class="mb-[18px] text-left" align="justify">Secara umum, sistem pakar adalah sistem yang berusaha mengadopsi pengetahuan manusia ke komputer yang dirancang untuk memodelkan kemampuan menyelesaikan masalah seperti layaknya seorang pakar. Dengan sistem pakar ini, orang awam pun dapat menyelesaikan masalahnya atau hanya sekedar mencari suatu informasi berkualitas yang hanya dapat diperoleh dengan bantuan para ahli di bidangnya (Mujilahwati, Siti, 2014).</p>
<p class="mb-[18px] text-left" align="justify">Istilah sistem pakar berasal dari kata knowledge-based expert system. Istilah ini muncul karena untuk memecahkan suatu masalah, sistem pakar menggunakan pengetahuan yang dimasukkan ke dalam komputer. Seseorang yang bukan pakar menggunakan sistem pakar untuk meningkatkan kemampuan pemecahan masalah, sedangkan seorang pakar menggunakan sistem pakar untuk knowledge assistant (Rahman, Fakhrul, Eka Praja Wiyata Mandala dan Teri Ade Putra, 2017).</p>
</div>
