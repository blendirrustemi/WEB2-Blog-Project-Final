<?php
    require "common/navbar.php"; #requires the navbar from the common folder
    require "common/database_connect.php"; #requires the database file from the common folder

    if (!$role){ #checks if the user is an admin, if not it redirects to the homepage
        header("Location: index.php");
    }

    $query = "SELECT * FROM users ORDER BY date DESC";#query to select all the users from the most recent ones
    $result = mysqli_query($db, $query);#executes the above query

    $user_data = mysqli_fetch_all($result, MYSQLI_ASSOC);#saves the users array to the user_data variable
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/manage_users.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Manage Users</title>
</head>
<body>
    
    <div class="main-cont">
    <h1>All the users of the blog!</h1>
        <?php foreach ($user_data as $users): #starts the forloop for every user indivudually and creates the below elements for each user?>
        <div class="page-container">
            <div class="users">
                <div class="users-main">
                    
                    <div class="user-name">
                        <p><?php echo $users['Name']#displays the Name for each individual user?></p>
                    </div>
    
                    <div class="user-surname">
                        <p><?php echo $users['Surname']#displays the Surname for each individual user?></p>
                    </div>
    
                    <div class="user-username">
                        <p><?php echo $users['Username']#displays the Username for each individual user?></p>
                    </div>
    
                    <div class="user-email">
                        <p><?php echo $users['Email']#displays the Email for each individual user?></p>
                    </div>
    
                    <div class="user-gender">
                        <p><?php echo $users['Gender']#displays the Gender for each individual user?></p>
                    </div>
    
                    <div class="user-date">
                        <p><?php echo $users['DOB']#displays the Date of Birth for each individual user?></p>
                    </div>
    
                    <?php if (!$users['Registered_User']):#while it is looping, it checks if that user is a registered user, if not it displays the Approve button below, so the admin can approve its account?>
                        <div>
                            <a href="common/approve_user.php?id=<?php echo $users['U_ID']?>"><button class="btn-approve buton">Approve</button></a>
                        </div>
                    <?php endif#ends the above if statement?>
    
    
                    <?php if (!$users['Admin']): #while it is looping, it checks if that user is an Admin, if not it displays the delete button for that user?>
                    <div>
                        <a href="common/delete_user.php?id=<?php echo $users['U_ID']?>"><button class="btn-delete buton">Delete</button></a>
                    </div>
                    <?php endif#ends the above if statement?>
    
                </div>
            </div>
        </div>
    
        <?php endforeach;#ends the forloop, so all the above elements are created for each individual user from the database?>
    </div>
</body>
</html>

