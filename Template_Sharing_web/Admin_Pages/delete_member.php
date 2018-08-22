<?php
session_start();
include 'database.php';
include 'security.php';
$database = new database();
$security = new security();
if(isset($_GET['memberID']))
{
    $id_old = $_GET['memberID'];
}
if ($security->checkadmin())
{
    $sql = "DELETE FROM member WHERE MemberID='$id_old'";
     $update=$database->query($sql);
     header("location:list_member.php");
}
?>