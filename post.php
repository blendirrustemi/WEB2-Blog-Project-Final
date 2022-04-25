<?php

    require 'common/database_connect.php';
    require "common/navbar.php";

    function query( $db, $p_id ) {

        $query = "SELECT * FROM posts WHERE P_ID='$p_id'";
        $result = mysqli_query( $db, $query );
        $post = mysqli_fetch_assoc( $result );

        return $post;
    }

    function commentQuery( $db, $p_id ) {
        $commentfetch = "SELECT * from comments WHERE P_ID='$p_id'";
        $commentfetchquery = mysqli_query( $db, $commentfetch );
        $comments = mysqli_fetch_all( $commentfetchquery, MYSQLI_ASSOC );

        return $comments;
    }

    if ( isset( $_GET['id'] ) ) {
        $p_id = htmlentities( mysqli_real_escape_string( $db, $_GET['id'] ) );

        // $query_usr = "SELECT * FROM users WHERE U_ID='$id'";
        // $result_usr = mysqli_query( $db, $query_usr );
        // $usr = mysqli_fetch_assoc( $result_usr );

        $post = query( $db, $p_id );
        $comments = commentQuery( $db, $p_id );
    } elseif ( isset( $_POST['submit'] ) ) {
        $p_id = htmlentities( mysqli_real_escape_string( $db, $_POST['p_id'] ) );

        $post = query( $db, $p_id );

        $comment = $_POST['comment'];
        $comment_query = "INSERT INTO comments(Comment, P_ID, username) VALUES('$comment', '$p_id', '$username')";
        if ( !mysqli_query( $db, $comment_query ) ) {
            echo "Error: " . mysqli_errno( $db );
        }
        $comments = commentQuery( $db, $p_id );

    } else {
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
                <h5><?php echo $post["Title"] ?></h5>
            </div>

            <div class="post-date">
                <p><?php echo date( 'Y-M-D : H-i', strtotime( $post['Date'] ) ) ?></p>
            </div>

            <div class="post-content">
                <p><?php echo $post['Content'] ?></p>
            </div>

            <hr>

            <!-- For loop for comments -->
            <?php foreach ( $comments as $comment ): ?>
            <div class="post-comment">
                <p><strong><?php echo $comment['username']?></strong></p>
                <p><?php echo $comment['Comment'] ?></p>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

            <?php if ( $user ): ?>
            <div class="input-form">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <textarea name="comment" id="" rows="5" placeholder="Enter a Comment" class="cmnt-area"></textarea>
                    <input type="submit" value="Post Comment" name="submit" class="submit-btn">
                    <input type="hidden" name="p_id" value="<?php echo $p_id ?>">
                </form>
            </div>
            <?php endif ?>
        </div>
</body>
</html>
