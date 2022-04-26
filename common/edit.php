<?php 
    require "sessions.php"; #requires sessions so it can validate the data
    require "database_connect.php"; #Requires database so it can use its values

    if (!$role){ # Condition to check if the user has a role of Admin set on the sessions file
        header("Location: ../index.php"); #If the user doesnt have the role Admin it redirects to the home page (index.php)
    }
    
    if (isset( $_POST["submit"])){ # checks if the submit button is clicked

        $hid = $_POST['hid']; #assigns the value that it receives from hid to the $hid variable

        $title = $_POST['title'];  #assigns the value that it receives from title to the $title variable
        $content = $_POST['content'];  #assigns the value that it receives from content to the $content variable
        
        $query = "UPDATE posts SET Title = '$title', Content='$content' WHERE P_ID='$hid'"; # query to update the title and the content of the blog on the database;
        $result = mysqli_query( $db, $query ); # Exectues the above query

        header("Location: ../index.php"); #redirects to the home page
    }
?>