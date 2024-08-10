<?php
  $qmaks = $conn->query("SELECT max(substr(lin_id_supplier026,-4))+1 as MAKS FROM `lin_supplier026`"); #bukan tanda petik tapi tanda disamping angka 1 `
  $dtmaks = $qmaks->fetch_object();
  if($dtmaks->MAKS==NULL):
    $lin_txt_id_supplier026 = "S0001";
  else:
   $maks = $dtmaks->MAKS;
    if($maks < 10):
      $lin_txt_id_supplier026 = "S000" . $maks;
    elseif($maks < 100):
      $lin_txt_id_supplier026 = "S00" . $maks;
    elseif($maks < 1000):
      $lin_txt_id_supplier026 = "S0" . $maks;
    elseif($maks < 10000):
      $lin_txt_id_supplier026 = "S" . $maks;
    else:
      $lin_txt_id_supplier026 = "S0001";
    endif; 
  endif;
  
?>



<?php
  if(isset($_GET["aksi"])):
    $aksi = $_GET["aksi"];
    $lin_txt_id_supplier026 = $_GET["kode"];
    if($aksi=="hapus"):
      #awal hapus
        $qcari = $conn->query("SELECT * FROM lin_supplier026 WHERE lin_id_supplier026='$lin_txt_id_supplier026'");
        if(mysqli_num_rows($qcari) > 0):
          $qdel = $conn->query("DELETE FROM lin_supplier026 WHERE lin_id_supplier026='$lin_txt_id_supplier026'");
          if($qdel):
            ?>
            <div class="alert alert-success">
              <strong>Success!</strong> Berhasil dihapus!
            </div>
            <?php
          else:
            ?>
              <div class="alert alert-danger">
                <strong>Danger!</strong> Gagal hapus, karena <?= mysqli_error($conn) ?>!
              </div>
            <?php
          endif;
        else:
          ?>
            <div class="alert alert-danger">
              <strong>Danger!</strong> Gagal hapus, karena record dengan kode supplier <?= $lin_id_supplier026 ?> tidak ada!
            </div>
          <?php
        endif;
        
        echo "<meta http-equiv='refresh'
          content='2;url=admin.php?page=linkku&hal=lin_supplier026'>";
      #akhir hapus
    elseif ($aksi=="ubah"):
      #awal ubah
        $qup = $conn->query("SELECT * FROM lin_supplier026 WHERE lin_id_supplier026='$lin_txt_id_supplier026'");
        $dtup = $qup->fetch_object();
        $lin_txt_nm_supplier026 = $dtup->lin_nm_supplier026;
        $lin_txt_no_wasupplier026 = $dtup->lin_no_wasupplier026;
        $lin_txt_al_supplier026 = $dtup->lin_al_supplier026;
          
      #akhir ubah
    endif;
  endif;
     
?>

<?php
  if (isset($_POST['btnubah'])):
    $lin_txt_nm_supplier026   = $_POST['lin_txt_nm_supplier026'];
    $lin_txt_no_wasupplier026  = $_POST['lin_txt_no_wasupplier026'];
    $lin_txt_al_supplier026 = $_POST['lin_txt_al_supplier026'];
    $conn->query("UPDATE lin_supplier026 SET lin_nm_supplier026='$lin_txt_nm_supplier026', lin_no_wasupplier026='$lin_txt_no_wasupplier026', lin_al_supplier026='$lin_txt_al_supplier026' WHERE lin_id_supplier026='$lin_txt_id_supplier026' ");
    echo "<meta http-equiv='refresh' content='2;url=admin.php?page=linkku&hal=lin_supplier026'>";
  endif;
?>

<?php
  $lin_id_supplier026 = ""; $lin_nm_supplier026 = ""; $lin_no_wasupplier026  = ""; $lin_al_supplier026 = ""; 

  if (isset($_POST['btnsimpan'])):
    $lin_id_supplier026   = $_POST['lin_txt_id_supplier026'];
    $lin_nm_supplier026   = $_POST['lin_txt_nm_supplier026'];
    $lin_no_wasupplier026  = $_POST['lin_txt_no_wasupplier026'];
    $lin_al_supplier026 = $_POST['lin_txt_al_supplier026'];
  

    $conn->query("INSERT INTO lin_supplier026 
      (lin_id_supplier026, lin_nm_supplier026, lin_no_wasupplier026, lin_al_supplier026) 
      VALUES 
      ('$lin_id_supplier026', '$lin_nm_supplier026', '$lin_no_wasupplier026', '$lin_al_supplier026') ");
    echo "<meta http-equiv='refresh' content='1;url=admin.php?page=linkku&hal=lin_supplier026'>";
  endif;
?>



<div class="container">
  <h2>Form Supplier</h2>

  <form action="" method="POST" class="was-validated" enctype="multipart/form-data"> //krn perlu mengupload data, kyk foto
    <div class="form-group">
      <label for="lin_txt_id_supplier026">ID Supplier:</label>
      <input readonly type="text" minlength="6" maxlength="6" class="form-control" id="lin_txt_id_supplier026" placeholder="Isi Kode Supplier" name="lin_txt_id_supplier026" value="<?= $lin_txt_id_supplier026 ?>" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="lin_txt_nm_supplier026">Nama Supplier:</label>
      <input type="text" maxlength="100" class="form-control" id="lin_txt_nm_supplier026" placeholder="Isi Nama Supplier" name="lin_txt_nm_supplier026" required value="<?= $lin_txt_nm_supplier026 ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="lin_txt_no_wasupplier026">No Whatsapp Supplier:</label>
      <input type="text" maxlength="20" class="form-control" id="lin_txt_no_wasupplier026" placeholder="Isi No Whatsapp Supplier" name="lin_txt_no_wasupplier026" required value="<?= $lin_txt_no_wasupplier026 ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="lin_txt_al_supplier026">Alamat Supplier:</label>
      <textarea rows="7" maxlength="1000" class="form-control" id="lin_txt_al_supplier026" placeholder="Isi Alamat Supplier" name="lin_txt_al_supplier026" required><?= $lin_txt_al_supplier026 ?></textarea>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
    <button type="submit" name="btnubah" class="btn btn-warning">Ubah</button>
  </form>

  <hr>
  <h2>Data Supplier</h2>
  <table class="table table-dark table-hover table-striped">
    <thead>
      <tr>
        <th>ID Supplier</th>
        <th>Nama Suplier</th>
        <th>No Whatsapp Supplier</th>
        <th>Alamat Supplier</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $q = $conn->query("SELECT * FROM lin_supplier026 ORDER BY lin_id_supplier026 ASC");
      while ($dt = $q->fetch_object()):
      ?>
        <tr>
          <td><?= $dt->lin_id_supplier026 ?></td>
          <td><?= $dt->lin_nm_supplier026 ?></td>
          <td><?= $dt->lin_no_wasupplier026 ?></td>
          <td><?= $dt->lin_al_supplier026 ?></td>
          <td>
            <a class="btn btn-warning" href="admin.php?page=linkku&hal=lin_supplier026&aksi=ubah&kode=<?= $dt->lin_id_supplier026 ?>"><i class="fa fa-pencil-square-o"></i></a> 
            <a class="btn btn-danger" href="admin.php?page=linkku&hal=lin_supplier026&aksi=hapus&kode=<?= $dt->lin_id_supplier026 ?>" onclick="return confirm('Yakin menghapus <?= $dt->lin_nm_supplier026 ?> ?');"><i class="fa fa-trash-o"></i></a> 
          </td>
        </tr>
      <?php
      endwhile;
    ?>
    </tbody>
  </table>
</div>

<script>
  document.getElementById("lin_txt_nm_supplier026").focus();
</script>