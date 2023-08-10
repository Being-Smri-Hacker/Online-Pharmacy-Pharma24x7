<?php
session_start();
if (isset($_SESSION['user']))
{
  header("location:subscriberphno299.php");
  exit();
}
else
{
header("location:login.php?redirect=subscribe.php");
exit();
}
?>
