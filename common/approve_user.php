<?php
    require "database_connect.php";# Requires the database from its folder
    // require "../manage_users.php";# Requires manage_users.php file from the WEB2-Blog... folder
     
    if (!$role){# Condition to check if the user has a role of Admin set on the sessions file
        header("Location: index.php"); # If the user doesnt have the role Admin it redirects to the home page (index.php)
    }

    if (!isset($_GET['id'])){#Condition to check if this page has received an 'id' with GET
        header("Location: ../manage_users.php");#if not set then redirect to the manage_users.php again
    }
    
    $user_ID = mysqli_real_escape_string($db, $_GET['id']);#This part saves the database with the 'id' to the variable user_ID
    $query = "UPDATE users SET Registered_User=1 WHERE U_ID=$user_ID"; # This is the query to update the user and set the user role to 1
    
    
    if (!mysqli_query($db, $query)){#Condition to check if the database failed to execute the query
        echo "Error: " . mysqli_error($db);#Then it displays this error if it failed
    }
    header("Location: ../manage_users.php");# Redirects to the manage_users.php file to approve/delete users
?>