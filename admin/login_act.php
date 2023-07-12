<?php
   include_once("../library/inc.connection.php");
   include_once("../library/inc.function.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      $username = test_input($_POST["username"]);
      $password = test_input($_POST["password"]);
      $password = md5($password);

      $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) != 0){
         session_start();
         $_SESSION["usersmecon"] = $username;
         $_SESSION["passsmecon"] = md5($password);
         header("location:index.php");
      }else
         header("location:login.php?login=gagal");
   }else
      header("location:login.php");
 ?>
