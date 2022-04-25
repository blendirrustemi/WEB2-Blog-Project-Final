<?php
    require "common/navbar.php";
    require "common/database_connect.php";

    if (!$role){
        header("Location: index.php");
    }

    $query = "SELECT * FROM posts";
    $result = mysqli_query($db, $query);

    $user_data = mysqli_fetch_all($result, MYSQLI_ASSOC);


?>

<link rel="stylesheet" href="style/manage-blogs.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<div class="main-cont">
        <h2>Manage Blogs</h2>
        <?php
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
                    <div class="butonat">
                    <div class="edit-post">
                        <a href="edit_blog.php?id=<?php echo $blog_post['P_ID'] ?>"><button class="butoni">Edit Post</button></a>
                    </div>

                    <div class="del-post">
                        <a href="common/delete_blog.php?id=<?php echo $blog_post['P_ID'] ?>"><button class="butoni">Delete Post</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach ?>
