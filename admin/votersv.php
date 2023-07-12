<?php
include_once "../library/inc.session.php";
if ($_SERVER["REQUEST_METHOD"] != "POST")
   header("location:index.php?nav=voters");

$nis = $_POST["nis"];
$name = $_POST["name"];
$tgl = $_POST["tgl"];
$class = $_POST["class"];
$query = "INSERT INTO participants (nis, name, tgl, class)
      VALUES ('$nis', '$name', '$tgl', '$class')";
if (mysqli_query($conn, $query))
   header("location:index.php?nav=voters&act=Tambah Voter&stats=Berhasil");
else
   header("location:index.php?nav=voters&act=Tambah Voter&stats=Gagal");
