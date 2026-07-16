<?php include "koneksi.php"; ?>

<div>
  <button data-toggle="modal" data-target="#myModal" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>Hapus Semua Pesan</button>
</div>

<div class="table-responsive">
  <table class="table table-hover table-sm table-bordered">
    <thead>
      <tr id="thpo">
        <th width='3%' class="text-center">NO</th>
        <th class="text-center">PENGIRIM</th>
        <th width='20%' class="text-center">ACTION</th>
      </tr>
    </thead>
    <tbody class="bg-warning">

      <?php

      $sqlpe = mysqli_query($con, "SELECT DISTINCT(id_member) FROM pesanm WHERE status='notyet' ORDER BY status ASC");
      $no = 1;
      while ($rpe = mysqli_fetch_array($sqlpe)) {
        $sqlpeu = mysqli_query($con, "SELECT * FROM member WHERE id_member='$rpe[id_member]'");
        $rpeu = mysqli_fetch_array($sqlpeu);
        echo "<tr>
        <td>$no</td>
        <td>$rpeu[nama]</td>
        <td align='center'>
        <a href='?r=lihatpesan&idpe=$rpe[id_member]' class='btn btn-success'><span class='glyphicon glyphicon-eye-open'></span>LIHAT PESAN</a>
      </td>
    </tr>";

    $no++;
  }

  ?>

</tbody>

</table>
</div>

<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <form action="" method="post">
          <h4 class="modal-title">Konfirmasi</h4>
        </div>
        <div class="modal-body">
          Apakah Anda Yakin Akan menghapus semua pesan?

        </div>
        <div class="modal-footer">
          <input name="hapus" type="submit" class="btn btn-primary" id="hapus" value="hapus">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>

        </div>
      </form>
      <?php
      if (isset($_POST["hapus"])) {
        include "koneksi.php";
        mysqli_query($con, "DELETE FROM pesanm");

        if ($sqlpe) {
          echo "<div align='center'class='alert alert-success'>
          <strong>Pesan Berhasil Dihapus!
        </div>";
      } else {
        echo "<div align='center'class='alert alert-danger'>
        <strong>Pesan Gagal Dihapus!
      </div>";
    }
    echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=pesan'>";
  }
  ?>
</div>
</div>
</div>
</div>
