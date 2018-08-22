<?php
session_start();
ob_start();
?>
<?php 
session_destroy();
header("location:../access/login.php");
?>