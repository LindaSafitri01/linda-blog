<form method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fotobrg" id="fotobrg">
  <input type="submit" value="Upload Image" name="submit">
</form>

<?php
      if (isset($_FILES["fotobrg"]["name"]) && ($_FILES["fotobrg"]["name"]<>"")):
        $target_dir = "foto/";
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
?>