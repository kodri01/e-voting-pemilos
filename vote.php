<?php
include_once "library/inc.sessionvoter.php";

if (isset($_GET["nis"])) {
   $query = "UPDATE participants SET state='1' WHERE nis = $_SESSION[voternis]";
   if (mysqli_query($conn, $query)) {
      $query = "UPDATE candidates SET counts = (counts + 1) WHERE nis = '$_GET[nis]'";
      if (mysqli_query($conn, $query))
         header("location:login.php?vote=berhasil&name=$_SESSION[votername]");
      else {
         $query = "UPDATE participants SET state='0' WHERE nis = $_SESSION[voternis]";
         mysqli_query($conn, $query);
         header("location:index.php?vote=gagal");
      }
   }
} else
   header("location:index.php");