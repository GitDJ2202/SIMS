<?php
    session_start();
    include('db.php');

    $DelSupp = "DELETE FROM supplier WHERE `id` = '".$_GET['id']."' ";
    $DelContact = "DELETE FROM contact WHERE `id` = '".$_GET['id']."' ";

    $ResultDelSupp = $con->query($DelSupp);
    $ResultDelContact = $con->query($DelContact);
                                    
    if($ResultDelSupp && $ResultDelContact){
        echo "<script>alert('Selected record removed');</script>";
        echo "<script>window.location='viewSupplier.php';</script>";
    }
            
?>