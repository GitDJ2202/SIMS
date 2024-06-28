<?php
    session_start();
    include('db.php');


$DelItem = "DELETE FROM masterStockRecord WHERE `id` = '".$_GET['id']."' ";echo $DelUser;
$ResultDelItem = $con->query($DelItem);
echo "<script>alert('Item deleted');</script>";
echo "<script>window.location='viewStock.php';</script>";
?>        