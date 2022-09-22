<?php
session_start();
?>
<?php
   session_start();
   unset($_SESSION['login']);
   unset($_SESSION['user_id']);
   unset($_SESSION['user_firstname']);
   unset($_SESSION['user_lastname']);
   unset($_SESSION['user_password']);
   unset($_SESSION['user_phone_number']);
   unset($_SESSION['user_address']);
   unset($_SESSION['user_email']);
   header("Location: index.php");
   
?>