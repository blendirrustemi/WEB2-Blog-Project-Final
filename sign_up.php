<?php require "common/navbar.php"?>

<?php

    $showErrorMessage = false;
    $usernameExists = false;
    $showPassMessage = false;
    $emailExists = false;

    if ( isset( $_POST['submit'] ) ) {
        require "common/database_connect.php";

        $name = htmlentities( mysqli_real_escape_string( $db, $_POST['name'] ) );
        $surname = htmlentities( mysqli_real_escape_string( $db, $_POST['surname'] ) );
        $email = htmlentities( mysqli_real_escape_string( $db, $_POST['email'] ) );
        $username = htmlentities( mysqli_real_escape_string( $db, $_POST['username'] ) );
        $password = htmlentities( mysqli_real_escape_string( $db, $_POST['password'] ) );
        $gender = htmlentities( mysqli_real_escape_string( $db, $_POST['gender'] ) );
        $dob = htmlentities( mysqli_real_escape_string( $db, $_POST['dob'] ) );

        if (
            trim( $name ) != '' &&
            trim( $surname ) != '' &&
            trim( $email ) != '' &&
            trim( $username ) != '' &&
            trim( $password ) != '' &&
            trim( $gender ) != '' &&
            trim( $dob ) != ''
        ) {
            $query = "
        insert into Users
            (Name, Surname, Email, Username, Password, Gender, DOB)
                values ('$name','$surname', '$email', '$username', '$password', '$gender', '$dob')
        ";

            if ( strlen( $password ) < 8 ) {
                $showPassMessage = true;
            } elseif (!mysqli_query($db, $query)){
                    // mysqli_query( $db, $query );
                    $error = mysqli_error($db);
                    if ($error == "Duplicate entry '$email' for key 'Email'"){
                        $emailExists = true;
                    }elseif ($error == "Duplicate entry '$username' for key 'Username'"){
                        $usernameExists = true;
                    }
            }else{
                header("Location: login.php");
            }
            
        } else {
            $showErrorMessage = true;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style/new-account.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="signup-container">
        <h1 class="signup-title">Create a new account.</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

            <?php if ( $showErrorMessage ): ?>
            <div class="show-error">
                <strong>
                    <p>Please fill all the fields.</p>
                </strong>
            </div>
            <?php endif ?>

            <div class="forms">
                <!-- <label for="name">Name</label> -->
                <input type="text" name="name" id="name" placeholder="Name" value="<?php echo isset( $_POST['name'] ) ? $name : '' ?>">
            </div>

            <div class="forms">
                <!-- <label for="surname">Surname</label> -->
                <input type="text" name="surname" placeholder="Surname" id="surname"
                    value="<?php echo isset( $_POST['surname'] ) ? $surname : '' ?>">
            </div>

            <div class="forms">
                <!-- <label for="email">Email</label> -->
                <input type="email" name="email" placeholder="Email" id="email"
                    value="<?php echo isset( $_POST['email'] ) ? $email : '' ?>">
            </div>
            <?php if ( $emailExists ): ?>
            <div class="show-error">
                <strong>
                    <p>Email already exists.</p>
                </strong>
            </div>
            <?php endif ?>

            <div class="forms">
                <!-- <label for="username">Username</label> -->
                <input class="username" type="text" name="username" placeholder="Username" id="username"
                    value="<?php echo isset( $_POST['username'] ) ? $username : '' ?>">
            </div>

            <?php if ( $usernameExists ): ?>
            <div class="show-error">
                <strong>
                    <p>Username already exists.</p>
                </strong>
            </div>
            <?php endif ?>

            <div class="forms">
                <!-- <label for="password">Password</label> -->
                <input type="password" name="password" placeholder="Password" id="password"
                    value="<?php echo isset( $_POST['password'] ) ? $password : '' ?>">
            </div>

            <?php if ( $showPassMessage ): ?>
            <div class="show-error">
                <strong>
                    <p>Password should be more than 8 characters.</p>
                </strong>
            </div>
            <?php endif ?>

            <div class="forms" id="genderform">
                <label for="gender">Gender</label>
                <select required name="gender" id="gender">
                    <option value="" selected disabled>Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="forms" id="date">
                <label for="dateofbirth">Date of Birth</label>
                <input type="date" name="dob" id="dateofbirth" value="<?php echo isset( $_POST['dob'] ) ? $dob : '' ?>">
            </div>
            <input class="signup-button" name="submit" type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
