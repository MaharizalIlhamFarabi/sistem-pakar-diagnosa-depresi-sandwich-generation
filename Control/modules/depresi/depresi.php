<?php include "koneksi.php"; ?>

<?php
if(isset($_POST["simpan"])){
  include "koneksi.php";
  $penanggulangan = nl2br($_POST["penanggulangan"]);
  $keterangan = nl2br($_POST["keterangan"]);
  $sqlp = mysqli_query($con, "INSERT INTO penyakit (kd_penyakit, nama_penyakit, keterangan, penanggulangan) VALUES ('$_POST[kd_penyakit]', '$_POST[nama_penyakit]', '$keterangan', '$penanggulangan')");

  if($sqlp){
    echo "<div align='center' class='alert alert-success'>
                <strong>Data Berhasil Ditambah!
                  </div>";
  }else{
    echo "<div align='center' class='alert alert-danger'>
                <strong>Data Gagal Ditambah!
                  </div>";
  }
   echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=penyakit'>";
}
   ?>


     <?php
     include "koneksi.php";
     if(isset($_POST["edit"])){

       $penanggulangan = nl2br($_POST["penanggulangan"]);
       $keterangan = nl2br($_POST["keterangan"]);
       $sqlp = mysqli_query($con, "UPDATE penyakit SET nama_penyakit='$_POST[nama_penyakit]', keterangan='$keterangan', penanggulangan='$penanggulangan' WHERE id_penyakit='$_POST[id_penyakit]'");
       if($sqlp){
         echo "<div align='center' class='alert alert-success'>
                     <strong>Data Berhasil Diupdate!
                       </div>";
       }else{
         echo "<div align='center' class='alert alert-danger'>
                     <strong>Data gagal Diupdate!
                       </div>";
       }
       echo "<META HTTP-EQUIV='Refresh' Content='1; URL=?r=penyakit'>";
     }
     ?>


<div>
<button data-toggle="modal" data-target="#myModal" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Tambah Data Penyakit</button>
</div>

<div class="table-responsive">
<table class="table table-hover table-sm table-bordered">
<thead>
<tr id="thpo">
  <th class="text-center">NO</th>
  <th class="text-center">KODE PENYAKIT</th>
  <th class="text-center">NAMA PENYAKIT</th>
  <th class="text-center">SARAN</th>
  <th width='20%' class="text-center">ACTION</th>
 </tr>
 </thead>
 <tbody class="">
 <?php
$sqlp = mysqli_query($con, "SELECT * FROM penyakit ORDER BY id_penyakit ASC");
$no = 1;
while($rp = mysqli_fetch_array($sqlp)){
  echo "<tr>
    <td >$no</td>
    <td>$rp[kd_penyakit]</td>
    <td>$rp[nama_penyakit]</td>
    <td>$rp[penanggulangan]</td>
    <td align='center'>
    <a href='javascript:showModalP(\"$rp[id_penyakit]\", \"$rp[kd_penyakit]\",\"$rp[nama_penyakit]\", \"$rp[keterangan]\", \"$rp[penanggulangan]\" )' class='btn btn-success' > <span class='glyphicon glyphicon-edit'></span>Edit</a>
    <a href='?r=penyakitdel&idp=$rp[id_penyakit]'class='btn btn-danger'>  <span class='glyphicon glyphicon-trash'></span>Hapus</a>
  </td>
  </tr>";
  $no++;
}
?>
</tbody>
 </table>
 </div>
 </div>
 </div>

 <!-- MODAL UNTUK TAMBAH penyakit -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah data penyakit</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Kode Penyakit</label>
						<input name="kd_penyakit" type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>Nama Penyakit</label>
						<input name="nama_penyakit" type="text" class="form-control">
					</div>
          <div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" type="text" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Saran</label>
						<textarea name="penanggulangan" type="text" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
				  <input name="simpan" type="submit" class="btn btn-primary" id="simpan" value="simpan">
					<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
				</div>
			</form>
        </div>
	</div>
</div>

<script type="text/javascript">
  function showModalP(id, kd_penyakit, nama_penyakit, keterangan, penanggulangan ) {
    $('#id_penyakit').val(id);
    $('#kd_penyakit').val(kd_penyakit);
    $('#nama_penyakit').val(nama_penyakit);
    $('#keterangan').val(keterangan);
    $('#penanggulangan').val(penanggulangan);
    $('#myModalP').modal('show');
  }
</script>

<!-- MODAL UNTUK EDIT penyakit -->
<div id="myModalP" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Data Penyakit</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
          <input id="id_penyakit" name="id_penyakit" type="hidden" class="form-control">
					<div class="form-group">
						<label>Kode Penyakit</label>
						<input id="kd_penyakit" name="kd_penyakit" type="text" class="form-control" disabled>
					</div>
					<div class="form-group">
						<label>Nama Penyakit</label>
						<input id="nama_penyakit" name="nama_penyakit" type="text" class="form-control">
					</div>
          <div class="form-group">
						<label>Keterangan</label>
						<textarea id="keterangan" name="keterangan" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>Saran</label>
						<textarea id="penanggulangan" name="penanggulangan" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
				  <input name="edit" type="submit" class="btn btn-primary" id="edit" value="Edit">
					<button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
				</div>
			</form>
        </div>
	</div>
</div>
