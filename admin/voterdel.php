<?php
include_once "../library/inc.session.php";

if (isset($_GET["nis"])) {
   $query = "DELETE FROM participants WHERE nis = '$_GET[nis]'";
   if (mysqli_query($conn, $query))
      header("location:index.php?nav=voters&act=Hapus Voter&stats=Berhasil");
   else
      header("location:index.php?nav=voters&act=Hapus Voter&stats=Gagal");
} else
   header("location:index.php?nav=voters");
