<?php
   include_once "../library/inc.connection.php";
   include_once "../library/inc.function.php";
   session_start();
   if(!isset($_SESSION["usersmecon"]) && !isset($_SESSION["passsmecon"]))
      header("location:../admin/login.php");
   else{
      $username = test_input($_SESSION["usersmecon"]);
      $query = "SELECT * FROM admin WHERE username = '$username'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) > 0){
         $row = mysqli_fetch_assoc($result);
         if($_SESSION["passsmecon"] != md5($row["password"]))
            header("location:../admin/logout.php");
         else {
            // Set session akses di sini
            $_SESSION["akses"] = $row["akses"];
         }
      }
   }
