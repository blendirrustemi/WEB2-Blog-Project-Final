<?php
    require "database_connect.php"; #Requires database so it can use its values

    
    if (!$role){  # Condition to check if the user has a role of Admin set on the sessions file
        header("Location: ../index.php");#If the user doesnt have the role Admin it redirects to the home page (index.php)
    }

    if (!isset($_GET['id'])){  # Condition to check if this page has received an 'id' with GET
        header("Location: ../manage_blogs.php"); # if not set then redirect to the manage_blogs.php again
    }
    
    $blog_id = mysqli_real_escape_string($db, $_GET['id']); # This part saves the database with the 'id' to the variable blog_ID

    $query_comm = "DELETE from comments WHERE P_ID='$blog_id'"; # This is the query to delete the comments with its corresponding post id
    $query = "DELETE from posts WHERE P_ID='$blog_id'"; # This is the query to delete the post with its corresponding id
    
    mysqli_query($db, $query_comm); #Executes the first query to the database
    mysqli_query($db, $query); #Executes the second query to the database



    if (!mysqli_query($db, $query)){ # Condition to check if the database failed to execute the query
        echo "Error: " . mysqli_error($db); #Then it displays this error if it failed
    }
    header("Location: ../manage_blogs.php"); # it redirects to the manage_blogs.php after the commands are executed
?>