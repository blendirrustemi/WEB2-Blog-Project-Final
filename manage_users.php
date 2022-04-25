<?php
    require "common/navbar.php";
    require "common/database_connect.php";

    if (!$role){
        header("Location: index.php");
    }

    $query = "SELECT * FROM users ORDER BY date DESC";
    $result = mysqli_query($db, $query);

    $user_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    
?>

<link rel="stylesheet" href="style/manage_users.css">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<div class="main-cont">
<h1>All the users of the blog!</h1>
    <?php foreach ($user_data as $users):?>
    <div class="page-container">
        <div class="users">
            <div class="users-main">
                
                <div class="user-name">
                    <p><?php echo $users['Name']?></p>
                </div>

                <div class="user-surname">
                    <p><?php echo $users['Surname']?></p>
                </div>

                <div class="user-username">
                    <p><?php echo $users['Username']?></p>
                </div>

                <div class="user-email">
                    <p><?php echo $users['Email']?></p>
                </div>

                <div class="user-gender">
                    <p><?php echo $users['Gender']?></p>
                </div>

                <div class="user-date">
                    <p><?php echo $users['DOB']?></p>
                </div>

                <?php if (!$users['Registered_User']): ?>
                    <div>
                        <a href="common/approve_user.php?id=<?php echo $users['U_ID']?>"><button class="btn-approve buton">Approve</button></a>
                    </div>
                <?php endif ?>


                <?php if (!$users['Admin']):?>
                <div>
                    <a href="common/delete_user.php?id=<?php echo $users['U_ID']?>"><button class="btn-delete buton">Delete</button></a>
                </div>
                <?php endif ?>

            </div>
        </div>
    </div>

    <?php endforeach ?>

</div>