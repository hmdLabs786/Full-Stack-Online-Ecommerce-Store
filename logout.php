<?php
session_start();

// Store admin session variables temporarily
$admin_username = $_SESSION['admin_username'] ?? null;
$admin_userrole = $_SESSION['admin_userrole'] ?? null;
$admin_userid = $_SESSION['admin_userid'] ?? null;

// Clear all session variables
session_unset();

// Restore admin session variables
if ($admin_username !== null) {
    $_SESSION['admin_username'] = $admin_username;
}
if ($admin_userrole !== null) {
    $_SESSION['admin_userrole'] = $admin_userrole;
}
if ($admin_userid !== null) {
    $_SESSION['admin_userid'] = $admin_userid;
}

echo "<script>location.assign('index.php')</script>";
?>