<?php
session_start();

// Only clear admin session variables, leave user sessions intact
unset($_SESSION['admin_username']);
unset($_SESSION['admin_userrole']);
unset($_SESSION['admin_userid']);

echo "<script>location.assign('login.php')</script>";
?>