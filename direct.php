<?php
session_start();
if (isset($_SESSION['user']))
{
  header("location:subscriberphnofree.php");
  exit();
}
else
{
header("location:login.php?redirect=subscribe.php");
exit();
}
?>
