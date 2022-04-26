<?php require "common/navbar.php" #requires the navbar to navigate easier throught the files ?> 
<?php


require "common/database_connect.php"; #requires the database

    # three boolean variables assigned to false, so if they are true later they display a message
    $show_error_message = false; 
    $show_user_message = false;
    $not_user_message = false;

    if ( isset( $_POST['submit'] ) ) { #checks if the form has been submited through the submit name
        #assigns the username and password from the database to its corresponding variables
        $username = htmlentities( mysqli_real_escape_string( $db, $_POST['username_login'] ) ); 
        $password = htmlentities( mysqli_real_escape_string( $db, $_POST['password_login'] ) );

        if ( trim( $username ) != '' and trim( $password ) != '' ) { #removes the whitespaces on the username and password and checks if they are blank
            $check_query = "select * from Users where username='$username' and password='$password'"; #query to select the username and password with the values entered by the user
            $result_query = mysqli_query( $db, $check_query ); #executes the query to check if the username and password exists
            
            $user_data = mysqli_fetch_assoc( $result_query ); #assigns the array got from the database to the variable user_data
            
            if ( !empty( $user_data ) ) { #checks if the above array is not empty
                if ( $username == $user_data['Username'] and $password == $user_data['Password'] ) { #confirms that the username/password is the same from the form entered by the user
                    if ( $user_data['Registered_User'] == 1 ) { #checks if the person logging in is a registered user
                        session_start(); #starts the session to use its variables
                        $_SESSION['user'] = $user_data; #assigns the array user_data to the session variable users
                        header( "Location: index.php" ); #redirects to the homepage
                    } else { #if not a user display the message
                        $not_user_message = true;
                    }
                } else { # credentials entered wrong message
                    $show_user_message = true;
                }
            } else {  # credentials entered wrong message
                $show_user_message = true;
            }
        } else { # credentials entered wrong message
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

            <?php if ( $show_error_message ): #checks if the eror is true and displays it ?>
                <div class="error-box">
                    <strong>
                        <p>Please fill all the fields to log in.</p>
                    </strong>
                </div>
            <?php endif #ends the above condition?>

            <?php if ( $show_user_message ): #checks if the eror is true and displays it?>
                <div class="error-box">
                    <strong>
                        <p>Incorrect Username or Password!</p>
                    </strong>
                </div>
            <?php endif  #ends the above condition?>

            <?php if ( $not_user_message ): #checks if the eror is true and displays it?>
                <div class="error-box">
                    <strong>
                        <p>Not a User! Please wait until an Admin Accepts your account.</p>
                    </strong>
                </div>
            <?php endif  #ends the above condition?>

            <div class="login-form-field username_field">
                <!-- <label for="">Username</label> -->
                <input type="text" placeholder="Username" name="username_login" value="<?php echo isset( $_POST['username_login'] ) ? $username : ''  #enters the values from the database if the credentials are wrong, so it doesnt delete the username when the page refreshes?>">
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