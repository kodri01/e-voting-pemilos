<?php
   function test_input($x)
   {
      $x = trim($x);
      $x = stripslashes($x);
      $x = htmlspecialchars($x);
      return $x;
   }
?>
