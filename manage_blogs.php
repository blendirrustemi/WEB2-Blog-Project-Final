<?php
    require "common/navbar.php"; #requires the navbar from the common folder
    require "common/database_connect.php"; #requires the database from the common folder

    if (!$role){ # checks if the user has an admin role, if not it redirects to the homepage
        header("Location: index.php");
    }

    $query = "SELECT * FROM posts"; #query to select everything from the posts table
    $result = mysqli_query($db, $query); #executues the above query and saves it to the variable result

    $user_data = mysqli_fetch_all($result, MYSQLI_ASSOC); #saves the array of the data got from the database to the user_data variable


?>

<link rel="stylesheet" href="style/manage-blogs.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<div class="main-cont">
        <h2>Manage Blogs</h2>
        <?php
            $select_query = "select * from posts order by date desc"; #query to select every post from the latest post by date

            $result_query = mysqli_query( $db, $select_query ); #executes the above query to the database
            $posts = mysqli_fetch_all( $result_query, MYSQLI_ASSOC ); #saves the array of the query executed to the posts variable

            foreach ( $posts as $blog_post ): #starts the for loop for each post in the database and creates each post individually with its corresponding data
        ?>
        <div class="page-container">
            <div class="posts">
                <div class="post-main">
                    <div class="post-title">
                        <h5><?php echo $blog_post["Title"] #displays the title from the database to the title name ?></h5>
                    </div>

                    <div class="post-date">
                        <p><?php echo date( 'Y-M-D : H-i', strtotime( $blog_post['Date'] ) ) #displays the date from the database to its corresponding post?></p>
                    </div>

                    <div class="post-content">
                        <p><?php echo $blog_post['Content']  #displays the content from the database to the content from its corresponding post ?></p>
                    </div>

                    <hr>
                    <div class="butonat">
                    <div class="edit-post">
                        <a href="edit_blog.php?id=<?php echo $blog_post['P_ID'] #gets the id from the post when we click edit?>"><button class="butoni">Edit Post</button></a>
                    </div>

                    <div class="del-post">
                        <a href="common/delete_blog.php?id=<?php echo $blog_post['P_ID'] #gets the id from the post when we click edit?>"><button class="butoni">Delete Post</button></a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach #ends the forloop here so all the above data is created for each iteration?>
