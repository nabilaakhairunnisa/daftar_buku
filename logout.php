<?php
session_start();
session_destroy();
setcookie("username", "", time() - 3600);  // Menghapus cookie
header("Location: login.php");
exit();
?>
