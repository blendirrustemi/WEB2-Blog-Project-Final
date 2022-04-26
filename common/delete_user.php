<?php
    require "database_connect.php"; #Requires database so it can use its values
    require "../manage_users.php";
    
    if (!$role){ # Condition to check if the user has a role of Admin set on the sessions file
        header("Location: ../index.php");  #If the user doesnt have the role Admin it redirects to the home page (index.php)
    }

    if (!isset($_GET['id'])){ # Condition to check if this page has received an 'id' with GET
        header("Location: ../manage_users.php"); # if not set then redirect to the manage_users.php again
    }
    
    $user_ID = mysqli_real_escape_string($db, $_GET['id']); # This part saves the database with the 'id' to the variable user_ID
    $query = "DELETE from users WHERE U_ID=$user_ID"; #This is the query to delete the user with its corresponding id
 
    header("Location: ../manage_users.php"); # it redirects to the manage_blogs.php after the commands are executed
    
    if (!mysqli_query($db, $query)){  # Condition to check if the database failed to execute the query
        echo "Error: " . mysqli_error($db);#Then it displays this error if it failed
    }
?>