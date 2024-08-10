<?php
  $nmbrg = ""; $katbrg = ""; $hrgbrg  = ""; $stokbrg = ""; $satbrg  = "";  $deskbrg = "";
  if(isset($_GET["aksi"])):
    $aksi = $_GET["aksi"];
    $kdbrg = $_GET["kode"];
    if($aksi=="hapus"):
      #awal hapus
        $qcari = $conn->query("SELECT * FROM tbl_barang WHERE kdbrg='$kdbrg'");
        if(mysqli_num_rows($qcari) > 0):
          $qdel = $conn->query("DELETE FROM tbl_barang WHERE kdbrg='$kdbrg'");
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
              <strong>Danger!</strong> Gagal hapus, karena record dengan kode barang <?= $kdbrg ?> tidak ada!
            </div>
          <?php
        endif;
        
        echo "<meta http-equiv='refresh'
          content='2;url=admin.php?page=linkku&hal=barang'>";
      #akhir hapus
    elseif ($aksi=="ubah"):
      #awal ubah
        $qup = $conn->query("SELECT * FROM tbl_barang WHERE kdbrg='$kdbrg'");
        $dtup = $qup->fetch_object();
        $nmbrg = $dtup->nmbrg;
        $katbrg = $dtup->katbrg;
        $hrgbrg = $dtup->hrgbrg;
        $stokbrg = $dtup->stokbrg;
        $satbrg = $dtup->satbrg;
        $deskbrg = $dtup->deskbrg;
        $fotobrg = $dtup->fotobrg;
      #akhir ubah
    endif;
  endif;
?>


<?php
  if (isset($_POST['btnsimpan'])): //if isset adalah jika sedang dilakukan, jdi jika sedang melakukan POST
    $kdbrg   = $_POST['kdbrg']; //di dalam POST adalah variabel
    $nmbrg   = $_POST['nmbrg']; //$kdbrg adalah values yg di insert into, atau nama vield
    $katbrg  = $_POST['katbrg'];
    $hrgbrg  = $_POST['hrgbrg'];
    $stokbrg = $_POST['stokbrg'];
    $satbrg  = $_POST['satbrg'];
    $deskbrg = $_POST['deskbrg'];
   
      if (isset($_FILES["fotobrg"]["name"]) && ($_FILES["fotobrg"]["name"]<>"")):
        $target_dir = plugin_dir_path( __DIR__ ) . "linda/foto/";
        $extension = end(explode(".", $_FILES["fotobrg"]["name"]));
        $namafilebarufoto = date("dmY") . date("His") . "." . $extension; #4
        if (file_exists($target_dir . $namafilebarufoto)):
          $filecount = 0;
          $files = glob($target_dir . "*");
          if ($files){           $filecount = count($files);         }
          $filecount+=1;
          $namafilebarufoto = date("dmY") . date("His") . $filecount . "." . $extension;
        endif;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_dir . $namafilebarufoto,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["fotobrg"]["tmp_name"]);
        if($check !== false) { #echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
        } else {  #echo "File is not an image.";
          $uploadOk = 0;
        }
        #if ($_FILES["fotobrg"]["size"] > 102400) { #echo "Sorry, your file is too large.";
        #  $uploadOk = 0;
        #}
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {   #echo "Sorry, only JPG, JPEG, PNG files are allowed.";
          $uploadOk = 0;
        }
        if ($uploadOk == 0) {   
          #echo "Sorry, your file was not uploaded.";
        } else { // if everything is ok, try to upload file
          if (move_uploaded_file($_FILES['fotobrg']['tmp_name'], $target_dir . $namafilebarufoto)) { 
            #echo "The file ". htmlspecialchars( basename( $namafilebarufoto)). " has been uploaded.";
          } else { 
            #echo "Sorry, there was an error uploading your file.";
          }
        }
      endif;

    $conn->query("INSERT INTO tbl_barang 
      (kdbrg, nmbrg, katbrg, hrgbrg, stokbrg, satbrg, deskbrg, fotobrg) 
      VALUES 
      ('$kdbrg', '$nmbrg', '$katbrg', '$hrgbrg', '$stokbrg', '$satbrg', '$deskbrg', '$namafilebarufoto') ");
  endif;
?>

<?php
  $qmaks = $conn->query("SELECT max(substr(kdbrg,-4))+1 as MAKS FROM `tbl_barang`"); #bukan tanda petik tapi tanda disamping angka 1 `
  $dtmaks = $qmaks->fetch_object();
  if($dtmaks->MAKS==NULL):
    $kdbrg = "B-0001";
  else:
   $maks = $dtmaks->MAKS;
    if($maks < 10):
      $kdbrg = "B-000" . $maks;
    elseif($maks < 100):
      $kdbrg = "B-00" . $maks;
    elseif($maks < 1000):
      $kdbrg = "B-0" . $maks;
    elseif($maks < 10000):
      $kdbrg = "B-" . $maks;
    else:
      $kdbrg = "B-0001";
    endif; 
  endif;
  
?>

<div class="container">
  <h2>Form Barang</h2>

  <form action="" method="POST" class="was-validated" enctype="multipart/form-data"> //krn perlu mengupload data, kyk foto
    <div class="form-group">
      <label for="kdbrg">Kode Barang:</label>
      <input readonly type="text" minlength="6" maxlength="6" class="form-control" id="kdbrg" placeholder="Isi Kode Barang" name="kdbrg" value="<?= $kdbrg ?>" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="nmbrg">Nama Barang:</label>
      <input type="text" maxlength="100" class="form-control" id="nmbrg" placeholder="Isi Nama Barang" name="nmbrg" required value="<?= $nmbrg ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="katbrg">Kategori Barang:</label> 
      //style dibawah ini agar select agar bisa sampai full 100%, dan maksa, namanya meng overate
      <style>
        .wp-core-ui select {
          width: 100% !important;
          max-width: 100% !important;
        }
      </style>
      <select name="katbrg" required class="form-control" id="katbrg">
        <option selected disabled value="">--Pilih Kategori Barang--</option>
        <option <?= ($katbrg=="Sembako") ? "selected" : "" ?> >Sembako</option>
        <option <?= ($katbrg=="Elektronik") ? "selected" : "" ?> >Elektronik</option>
        <option <?= ($katbrg=="Fashion") ? "selected" : "" ?> >Fashion</option>
        <option <?= ($katbrg=="ATK") ? "selected" : "" ?> >ATK</option>
        <option <?= ($katbrg=="Kecantikan") ? "selected" : "" ?> >Kecantikan</option>
      </select>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="hrgbrg">Harga Barang:</label>
      <input type="number" maxlength="8" class="form-control" id="hrgbrg" placeholder="Isi Harga Barang" name="hrgbrg" required value="<?= $hrgbrg ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="stokbrg">Stok Barang:</label>
      <input type="number" maxlength="4" class="form-control" id="stokbrg" placeholder="Isi Harga Barang" name="stokbrg" required value="<?= $stokbrg ?>">
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="satbrg">Satuan Barang:</label>

      <select class="form-control" id="satbrg" name="satbrg" required>
        <option selected disabled value="">--Pilih Satuan Barang--</option>
        <option <?= ($satbrg=="bh") ? "selected" : "" ?> >bh</option>
        <option <?= ($satbrg=="pcs") ? "selected" : "" ?> >pcs</option>
        <option <?= ($satbrg=="ktk") ? "selected" : "" ?> >ktk</option>
        <option <?= ($satbrg=="bks") ? "selected" : "" ?> >bks</option>
        <option <?= ($satbrg=="kg") ? "selected" : "" ?> >kg</option>
        <option <?= ($satbrg=="lt") ? "selected" : "" ?> >lt</option>
        <option <?= ($satbrg=="ls") ? "selected" : "" ?> >ls</option>
        <option <?= ($satbrg=="ons") ? "selected" : "" ?> >ons</option>
        <option <?= ($satbrg=="gr") ? "selected" : "" ?> >gr</option>
      </select>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <div class="form-group">
      <label for="deskbrg">Deskripsi Barang:</label>

      <textarea rows="7" maxlength="1000" class="form-control" id="deskbrg" placeholder="Isi Deskripsi Barang" name="deskbrg" required><?= $deskbrg ?></textarea>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>
    <div class="form-group">
      <label for="fotobrg">Foto Barang:</label>
      <input type="file" maxlength="25" class="form-control" id="fotobrg" placeholder="Isi Deskripsi Barang" name="fotobrg" required>
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Please fill out this field.</div>
    </div>

    <button type="submit" name="btnsimpan" class="btn btn-primary">Simpan</button>
  </form>

  <hr>
  <h2>Data Barang</h2>
  <table class="table table-dark table-hover table-striped">
    <thead>
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Kategori Barang</th>
        <th>Harga Barang</th>
        <th>Stok Barang</th>
        <th>Foto Barang</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $q = $conn->query("SELECT * FROM tbl_barang ORDER BY kdbrg ASC");
      while ($dt = $q->fetch_object()):
      ?>
        <tr>
          <td><?= $dt->kdbrg ?></td>
          <td><?= $dt->nmbrg ?></td>
          <td><?= $dt->katbrg ?></td>
          <td>Rp. <?= number_format($dt->hrgbrg,0,",",".") ?>,- / <?= $dt->satbrg ?> </td>
          <td><?= $dt->stokbrg ?> <?= $dt->satbrg ?></td>
          <td>
            <a href="<?= plugin_dir_url( __FILE__ ) . 'foto/' . $dt->fotobrg ?>" data-lightbox="image-1" data-title="My caption"><img width="50px" src="<?= plugin_dir_url( __FILE__ ) . 'foto/' . $dt->fotobrg ?>"></a>
            
          </td>
          <td>
            <a class="btn btn-warning" href="admin.php?page=linkku&hal=barang&aksi=ubah&kode=<?= $dt->kdbrg ?>"><i class="fa fa-pencil-square-o"></i></a> 
            <a class="btn btn-danger" href="admin.php?page=linkku&hal=barang&aksi=hapus&kode=<?= $dt->kdbrg ?>" onclick="return confirm('Yakin menghapus <?= $dt->nmbrg ?> ?');"><i class="fa fa-trash-o"></i></a> 
          </td>
        </tr>
      <?php
      endwhile;
    ?>
    </tbody>
  </table>
</div>

<script>
  document.getElementById("nmbrg").focus();
</script>