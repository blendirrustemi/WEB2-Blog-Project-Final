<?php require "sessions.php" ?>

<link rel="stylesheet" href="./style/navi.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<nav>
    <ul class="nav-list">
        <li class="nav-item">
            <a href="./index.php">Programming Blog</a>
        </li>

        <?php if ( $user ): ?>
            <?php if ($role): ?>
            <li class="nav-item">
                <a href="./admin_dash.php">Admin</a>
            </li>
            <?php endif ?>

        <li class="nav-item">
            <a href="logout.php">Logout</a>
        </li>
        <?php else: ?>

        <li class="nav-item">
            <a href="./login.php">Login</a>
        </li>

        <li class="nav-item">
            <a href="./sign_up.php">Signup</a>
        </li>
        <?php endif ?>

        <?php if ( $user ): ?>
            <li class="nav-item emri">
            <h4 class="color-user"><?php echo $name ?></h4>
        </li>

        <?php else: ?>
            <li class="nav-item emri">
            <h4 class="color-user">Guest</h4>
        </li>

        <?php endif ?>

    </ul>
</nav>
