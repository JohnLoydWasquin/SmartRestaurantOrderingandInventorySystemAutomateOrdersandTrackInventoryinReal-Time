<?php
session_start();
session_destroy();

header("Location: ../ADMIN/adminLogin.php");
exit();
?>
