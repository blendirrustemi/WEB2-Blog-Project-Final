<?php
    require "common/navbar.php"; #require the navbar so it can navigate through files
    require "common/database_connect.php";
    
    if (!$role){ #checks if the user has the role of an admin
        header("Location: ../index.php"); #if not redirect to home page
    }
    
    if ( isset( $_GET['id'] ) ) { #checks if it has received an id from the get method
        $p_id = htmlentities( mysqli_real_escape_string( $db, $_GET['id'] ) ); #assigns the database with id to the p_id variable
        
        $query = "SELECT * FROM posts WHERE P_ID='$p_id'"; #query to select all the posts with the id we have clicked
        $result = mysqli_query( $db, $query ); # executes the query to the database
        $post = mysqli_fetch_assoc( $result ); #assigns the result got from database to the variable $post

    }
?>

<link rel="stylesheet" href="./style/edit-blog.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


<div class="add_post">
        <h2>What do you want to change in the Blog?</h2>
        <form action="common/edit.php" method="post">

            <div class="input_field">
                <label for="title">Change the Title:</label>
                <input type="text" name="title" id="title" value="<?php echo $post['Title'] #title of the blog from the database?>">
            </div>

            <div class="input_field">
                <label for="content">Change the Content:</label>
                <textarea name="content" id="content" rows="6"><?php echo $post['Content'] #content of the blog from the database?></textarea>
            </div>

            <input type="hidden" name="hid" value="<?php echo $p_id #helps to identify the id of the post when selected?>">

            <input type="submit" name="submit" value="Post" class="buton">
        </form>
    </div>