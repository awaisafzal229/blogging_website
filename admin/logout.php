<?php
include "../Config.php";
session_start();
session_unset();
session_destroy();
setcookie(session_name(), '', time() - 3600, '/'); // Delete session cookie
header("location:http://localhost/blog/login.php");
exit();
?>