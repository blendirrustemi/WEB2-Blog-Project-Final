<?php

    require 'common/database_connect.php'; #requires the database from the common folder
    require "common/navbar.php"; #requires the navbar from the common folder

    function query( $db, $p_id ) { #function which requires the database connection and post id as parameters, then it executes the query to select all posts with the required post id, and saves the array to the post variable

        $query = "SELECT * FROM posts WHERE P_ID='$p_id'";
        $result = mysqli_query( $db, $query );
        $post = mysqli_fetch_assoc( $result );

        return $post;
    }

    function commentQuery( $db, $p_id ) { #function which requires the database connection and post id as parameters, then it executes the query to select all comments with the required post id, and saves the array to the comments variable
        $commentfetch = "SELECT * from comments WHERE P_ID='$p_id'";
        $commentfetchquery = mysqli_query( $db, $commentfetch );
        $comments = mysqli_fetch_all( $commentfetchquery, MYSQLI_ASSOC );

        return $comments;
    }

    if ( isset( $_GET['id'] ) ) { # checks if the id is set from the get method
        $p_id = htmlentities( mysqli_real_escape_string( $db, $_GET['id'] ) ); #saves the id to the post id variable after it has sanitized the inputs

        $post = query( $db, $p_id ); #calls the query function above and sends the database connection and post id
        $comments = commentQuery( $db, $p_id ); #calls the commentQuery function above and sends the database connection and post id
    } elseif ( isset( $_POST['submit'] ) ) {
        $p_id = htmlentities( mysqli_real_escape_string( $db, $_POST['p_id'] ) ); #saves the id to the post id variable after it has sanitized the inputs

        $post = query( $db, $p_id ); #calls the query function above and sends the database connection and post id

        $comment = $_POST['comment']; #saves to the comment variable the value it has received from the post comment
        $comment_query = "INSERT INTO comments(Comment, P_ID, username) VALUES('$comment', '$p_id', '$username')"; #query to insert the comment, post id and username into the comments table
        if ( !mysqli_query( $db, $comment_query ) ) { #checks if the query is not executed, and displays an error if not executed
            echo "Error: " . mysqli_errno( $db );
        }
        $comments = commentQuery( $db, $p_id ); #calls the commentQuery function above with the database connection and post id

    } else { #if neither of the conditions are not met then redirects to the homepage
        header( "Location: index.php" );
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post                <?php echo $p_id ?></title>
    <link rel="stylesheet" href="style/expanded_post.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>


<div class="page-container">
    <div class="posts">
        <div class="post-main">
            <div class="post-title">
                <h5><?php echo $post["Title"] #displays the title of the blog from the database?></h5>
            </div>

            <div class="post-date">
                <p><?php echo date( 'Y-M-D : H-i', strtotime( $post['Date'] ) ) #displays the time of the blog posted from the database?></p>
            </div>

            <div class="post-content">
                <p><?php echo $post['Content'] #displays the content of the blog from the database?></p>
            </div>

            <hr>

            <!-- For loop for comments -->
            <?php foreach ( $comments as $comment ): # loops through all the comments individualy to post all the comments that are in the database?>
            <div class="single-comment">
                <div class="post-user">
                    <p><strong><?php echo $comment['username'] # displays the username of the person who added the comment?></strong></p>
                </div>
                <div class="post-comment">
                    <p><?php echo $comment['Comment'] # displays the comment from the databse?></p>
                </div>
            </div>
            <?php endforeach; #ends the forloop and created comments for each iteration?>

        </div>
    </div>

            <?php if ( $user ): #checks if the user session is true?>
            <div class="input-form">
                <!-- Form to add the comments -->
                <form action="<?php echo $_SERVER['PHP_SELF']; #action to send the data submited to this page ?>" method="post">
                    <textarea name="comment" id="" rows="5" placeholder="Enter a Comment" class="cmnt-area" required></textarea>
                    <input type="submit" value="Post Comment" name="submit" class="submit-btn">
                    <input type="hidden" name="p_id" value="<?php echo $p_id ?>">
                </form>
            </div>
            <?php endif #ends the above forloop ?>
        </div>
</body>
</html>
