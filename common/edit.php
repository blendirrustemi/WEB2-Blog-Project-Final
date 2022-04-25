<?php 
    require "sessions.php";
    require "database_connect.php";

    if (!$role){
        header("Location: ../index.php");
    }
    
    if (isset( $_POST["submit"])){

        $hid = $_POST['hid'];

        $title = $_POST['title'];
        $content = $_POST['content'];
        
        $query = "UPDATE posts SET Title = '$title', Content='$content' WHERE P_ID='$hid'";
        $result = mysqli_query( $db, $query );

        header("Location: ../index.php");
    }
?>