<?php
include_once "library/inc.connection.php";
include_once "library/inc.function.php";
session_start();
if (isset($_SESSION["voternis"]) && isset($_SESSION["votername"]) && isset($_SESSION["votertgl"])) {
   $voter = test_input($_SESSION["voternis"]);
   $tgl = test_input($_SESSION["votertgl"]);
   $query = "SELECT * FROM participants WHERE nis = '$voter' AND tgl = '$tgl'";
   $result = mysqli_query($conn, $query);
   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      // if($_SESSION["votername"] != $row["name"] || $_SESSION["votertgl"] != $row["tgl"] || $row["state"] == 1){
      if ($_SESSION["votername"] != $row["name"] || $_SESSION["votertgl"] != $row["tgl"]) {
         header("location:logout.php");
      }
   } else
      header("location:logout.php");
} else
   header("location:logout.php");
