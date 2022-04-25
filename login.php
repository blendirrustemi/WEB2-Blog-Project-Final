<?php require "common/navbar.php"?>
<?php


require "common/database_connect.php";


    $show_error_message = false;
    $show_user_message = false;
    $not_user_message = false;

    if ( isset( $_POST['submit'] ) ) {
        $username = htmlentities( mysqli_real_escape_string( $db, $_POST['username_login'] ) );
        $password = htmlentities( mysqli_real_escape_string( $db, $_POST['password_login'] ) );

        if ( trim( $username ) != '' and trim( $password ) != '' ) {
            $check_query = "select * from Users where username='$username' and password='$password'";
            $result_query = mysqli_query( $db, $check_query );
            
            $user_data = mysqli_fetch_assoc( $result_query );
            
            if ( !empty( $user_data ) ) {
                if ( $username == $user_data['Username'] and $password == $user_data['Password'] ) {
                    if ( $user_data['Registered_User'] == 1 ) {
                        session_start();
                        $_SESSION['user'] = $user_data;
                        header( "Location: index.php" );
                    } else {
                        $not_user_message = true;
                    }
                } else {
                    $show_user_message = true;
                }
            } else {
                $show_user_message = true;
            }
        } else {
            $show_error_message = true;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="style/new-login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>

<body>

    

    <div class="login-container">

    <h1 class="login_title">Welcome back!</h1>
    
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">

            <?php if ( $show_error_message ): ?>
                <div class="error-box">
                    <strong>
                        <p>Please fill all the fields to log in.</p>
                    </strong>
                </div>
            <?php endif ?>

            <?php if ( $show_user_message ): ?>
                <div class="error-box">
                    <strong>
                        <p>Incorrect Username or Password!</p>
                    </strong>
                </div>
            <?php endif ?>

            <?php if ( $not_user_message ): ?>
                <div class="error-box">
                    <strong>
                        <p>Not a User! Please wait until an Admin Accepts your account.</p>
                    </strong>
                </div>
            <?php endif ?>

            <div class="login-form-field username_field">
                <!-- <label for="">Username</label> -->
                <input type="text" placeholder="Username" name="username_login" value="<?php echo isset( $_POST['username_login'] ) ? $username : '' ?>">
            </div>

            <div class="login-form-field password_field">
                <!-- <label for="">Password</label> -->
                <input type="password" placeholder="Password" name="password_login">
            </div>

            <input type="submit" class="login_button" value="Log In" name="submit">

        </form>
    </div>
</body>

</html>