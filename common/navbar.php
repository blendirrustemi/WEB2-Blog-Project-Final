<?php require "sessions.php"  #requires sessions so it can validate the data?> 

<link rel="stylesheet" href="./style/navi.css"> <!-- Connects to the css file-->
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> <!-- a hint to browsers that the user is likely to need resources from the target resource's origin -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> <!-- Online google fonts used-->
<nav class="navup">
    <ul class="nav-list">
        <li class="nav-item">
            <a href="./index.php">Programming Blog</a>
        </li>

        <?php if ( $user ): #checks if the user is set on the sessions?> 
            <?php if ($role): #checks if the person logged in has the role of admin?>
            <li class="nav-item">
                <a href="./admin_dash.php">Admin</a>
            </li>
            <?php endif #ends the above if statement?> 

        <li class="nav-item">
            <a href="logout.php">Logout</a>
        </li>
        <?php else: #if the above condition is not met then do the following below: ?>

        <li class="nav-item">
            <a href="./login.php">Login</a>
        </li>

        <li class="nav-item">
            <a href="./sign_up.php">Signup</a>
        </li>
        <?php endif #this is the end of the if statement above?>

        <?php if ( $user ): #checks if the user is set on the sessions?>
            <li class="nav-item emri">
            <h4 class="color-user"><?php echo $name ?></h4>
        </li>

        <?php else: #if its not a user or admin then its a guest ?>
            <li class="nav-item emri">
            <h4 class="color-user">Guest</h4>
        </li>

        <?php endif ?>

    </ul>
</nav>
