<?php include "koneksi.php"; ?>

<div class="table-responsive">
    <table class="table table-hover table-sm table-bordered">
        <thead class="bg-primary">
            <tr id="thpo">
                <th width='5%' class="text-center">NO</th>
                <th class="text-center">NAMA LENGKAP</th>
                <th class="text-center">ACTION</th>
            </tr>
        </thead>
        <tbody>
<?php
$mysqli = new mysqli("localhost", "root", "", "cf_depresi");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$sqlh = $mysqli->query("SELECT DISTINCT(id_member) FROM hasil_konsultasi ORDER BY waktu ASC");
$no = 1;

if ($sqlh === false) {
    die("Error in SQL query: " . $mysqli->error);
}

while ($rh = $sqlh->fetch_assoc()) {
    $id_member = $rh['id_member'];
    $sqlhu = $mysqli->query("SELECT * FROM member WHERE id_member='$id_member'");
    
    if ($sqlhu === false) {
        die("Error in SQL query: " . $mysqli->error);
    }
    
    $rhu = $sqlhu->fetch_assoc();

    if ($rhu !== null) {
        echo "<tr>
                <td>$no</td>
                <td>{$rhu['nama']}</td>
                <td align='center'>
                    <a href='?r=lihathasil&idh=$id_member' class='btn btn-success'>
                        <span class='glyphicon glyphicon-eye-open'></span> LIHAT
                    </a>
                </td>
            </tr>";

        $no++;
    } else {
        // Handle jika $rhu adalah null
    }
}

$mysqli->close();
?>

        </tbody>
    </table>
</div>
