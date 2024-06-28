<?php
    session_start();
    include('db.php');

    $DelUser = "DELETE FROM users WHERE `id` = '".$_GET['id']."' ";
    $DelContact = "DELETE FROM contact WHERE `id` = '".$_GET['id']."' ";
    $DelUserLogin = "DELETE FROM userLogin WHERE `id` = '".$_GET['id']."' ";

    $ResultDelUser = $con->query($DelUser);
    $ResultDelContact = $con->query($DelContact);
    $ResultDelUserLogin = $con->query($DelUserLogin);
                                    
    if($ResultDelUser && $ResultDelContact && $ResultDelUserLogin){
        echo "<script>alert('Selected record removed');</script>";
    }
            
?>
<script>
    window.location="viewUser.php";
</script>