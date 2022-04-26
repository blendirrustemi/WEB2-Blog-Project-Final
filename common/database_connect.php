<?php
    
    $db = mysqli_connect('localhost', 'root', '', 'blog_project'); # Connects to the blog_project database and saves it to the $db variable

    if(mysqli_connect_errno()) { #if it fails to connect then it shows the error below:
        echo "Failed to connect to MySQL". mysqli_connect_errno();
    }

?>