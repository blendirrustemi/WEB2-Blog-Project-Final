<?php

    require "common/navbar.php"; #requires the navbar from the common folder

    if (!$role){ #checks if the user is an admin, if not it redirects it to the homepage
        header("Location: index.php");
    }

    if (isset( $_POST["submit"])){ #checks if the form submitted is from the name submit button
        require "common/database_connect.php"; #requires the database from the common folder

        $title = htmlentities( mysqli_real_escape_string( $db, $_POST["title"] ) ); #saves the title variable from the user after it has sanitized the inputs
        $content = htmlentities( mysqli_real_escape_string( $db, $_POST["content"] ) ); #saves the content variable from the user after it has sanitized the inputs

        $insert_query = "insert into posts(Title, Content) values('$title', '$content')"; #query to insert the values from the user to the databse for the blog post
        mysqli_query($db, $insert_query); #executes the above query to the database
        header("Location: index.php"); #redirects to the homepage
    }

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link rel="stylesheet" href="style/post_blog.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="add_post">
        <h2>Add a Blog!</h2>
        <form action="" method="post">

            <div class="input_field">
                <input type="text" name="title" id="title" placeholder="Add a Title">
            </div>

            <div class="input_field">
                <textarea name="content" id="content" rows="6" placeholder="Add Content"></textarea>
            </div>

            <input type="submit" name="submit" value="Post" class="post_button">
        </form>
    </div>
</body>
</html>