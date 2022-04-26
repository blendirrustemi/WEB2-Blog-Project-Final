<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style/blog-page.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body>
    <div class="main-cont">
        <div class="page-header">
        <h2>A Community of Bloggers</h2>
        </div>
        <?php
            require "common/database_connect.php";

            $select_query = "select * from posts order by date desc";

            $result_query = mysqli_query( $db, $select_query );
            $posts = mysqli_fetch_all( $result_query, MYSQLI_ASSOC );

            foreach ( $posts as $blog_post ):
        ?>
        <div class="page-container">
            <div class="posts">
                <div class="post-main">
                    <div class="post-title">
                        <h5><?php echo $blog_post["Title"] ?></h5>
                    </div>

                    <div class="post-date">
                        <p><?php echo date( 'Y-M-D : H-i', strtotime( $blog_post['Date'] ) ) ?></p>
                    </div>

                    <div class="post-content">
                        <p><?php echo $blog_post['Content'] ?></p>
                    </div>

                    <hr>

                    <!-- <div class="post-comment">
                        <p><?php echo $blog_post['Content'] ?></p>
                    </div> -->

                    <a class="read" href="post.php?id=<?php echo $blog_post['P_ID'] ?>">
                    <div class="btn-comment">
                        Read More <img src="style/pics/arrow2.png"> 
                    </div>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <?php endforeach ?>

</body>
</html>