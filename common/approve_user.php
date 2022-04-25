<?php
    require "database_connect.php";
    require "../manage_users.php";
    
    if (!$role){
        header("Location: index.php");
    }

    if (!isset($_GET['id'])){
        header("Location: ../manage_users.php");
    }
    
    $user_ID = mysqli_real_escape_string($db, $_GET['id']);
    $query = "UPDATE users SET Registered_User=1 WHERE U_ID=$user_ID";

    header("Location: ../manage_users.php");
    
    if (!mysqli_query($db, $query)){
        echo "Error: " . mysqli_error($db);
    }
?>