<?php
   include_once "../library/inc.session.php";
   if($_SERVER["REQUEST_METHOD"] != "POST")
      header("location:index.php?nav=candidates");

   $no = $_POST["no"];
   $nis = $_POST["nis"];
   $photo = $nis;
   $name = $_POST["name"];
   $class = $_POST["class"];
   $motto = $_POST["motto"];

   $target_dir = "../assets/img/";
   $target_file = $target_dir . $photo;
   if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))
   {
      $query = "INSERT INTO candidates(no_urut, nis, photo, name, class, motto)
      VALUES ('$no', '$nis', '$photo', '$name', '$class', '$motto')";
      if(mysqli_query($conn, $query))
         header("location:index.php?nav=candidates&act=Tambah Kandidat&stats=Berhasil");
      else{
         if(file_exists($target_file))
            unlink($target_file);
         header("location:index.php?nav=candidates&act=Tambah Kandidat&stats=Berhasil");
      }
   }else{
      header("location:index.php?nav=candidates&act=Tambah Kandidat&stats=Gagal");
   }
