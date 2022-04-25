<?php
    require "common/navbar.php";
    require "common/database_connect.php";

    if (!$role){
        header("Location: index.php");
    }
?>

<!-- 
 1. Post a Blog ./
 2. Manage Posts X NGJYS KA MET VLLAQKO
 3. Manage Users ./
-->

<link rel="stylesheet" href="style/admin_dash.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<div class="page-container">
    <div class="posts">
        <div class="post-main">

            <div class="post-blog">
                <h3>Add Blogs</h3>
                <p>Start writting your content here fellow programmer!</p>
                <a href="post_blog.php"><button class="butoni">Post a Blog</button></a>
            </div>
            
        </div>
    </div>
</div>

<div class="page-container">
    <div class="posts">
        <div class="post-main">

            <div class="post-blog">
                <h3>Manage Blogs</h3>
                <p>You can manage, edit and delete your blogs!</p>
                <a href="manage_blogs.php"><button class="butoni">Manage Blogs</button></a>
            </div>
            
        </div>
    </div>
</div>

<div class="page-container">
    <div class="posts">
        <div class="post-main">

            <div class="post-blog">
                <h3>Manage Users</h3>
                <p>Pick and choose your users!</p>
                <a href="manage_users.php"><button class="butoni">Manage Users</button></a>
            </div>
            
        </div>
    </div>
</div>