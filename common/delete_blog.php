<?php
    require "database_connect.php";

    
    if (!$role){
        header("Location: ../index.php");
    }

    if (!isset($_GET['id'])){
        header("Location: ../manage_blogs.php");
    }
    
    $blog_id = mysqli_real_escape_string($db, $_GET['id']);

    $query_comm = "DELETE from comments WHERE P_ID='$blog_id'";
    $query = "DELETE from posts WHERE P_ID='$blog_id'";
    
    mysqli_query($db, $query_comm);
    mysqli_query($db, $query);



    if (!mysqli_query($db, $query)){
        echo "Error: " . mysqli_error($db);
    }
    header("Location: ../manage_blogs.php");
?>