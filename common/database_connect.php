<?php
    
    $db = mysqli_connect('localhost', 'root', '', 'blog_project');

    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL". mysqli_connect_errno();
    }

?>