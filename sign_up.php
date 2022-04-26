<?php require "common/navbar.php" #requires the navbar from the common folder?> 

<?php
    
    # four boolean variables assigned to false, so if they are true later they display a message
    $showErrorMessage = false;
    $usernameExists = false;
    $showPassMessage = false;
    $emailExists = false;

    if ( isset( $_POST['submit'] ) ) { #checks if the form has been submited through the submit name
        require "common/database_connect.php"; #requires the database from the common folder

        #assigns the name, surname, email, username, password, gender, and date of birth after it has sanitized the fields, it adds the values to its corresponding variables
        $name = htmlentities( mysqli_real_escape_string( $db, $_POST['name'] ) );
        $surname = htmlentities( mysqli_real_escape_string( $db, $_POST['surname'] ) );
        $email = htmlentities( mysqli_real_escape_string( $db, $_POST['email'] ) );
        $username = htmlentities( mysqli_real_escape_string( $db, $_POST['username'] ) );
        $password = htmlentities( mysqli_real_escape_string( $db, $_POST['password'] ) );
        $gender = htmlentities( mysqli_real_escape_string( $db, $_POST['gender'] ) );
        $dob = htmlentities( mysqli_real_escape_string( $db, $_POST['dob'] ) );

        if ( #checks if name, surname, email... are not empty
            trim( $name ) != '' &&
            trim( $surname ) != '' &&
            trim( $email ) != '' &&
            trim( $username ) != '' &&
            trim( $password ) != '' &&
            trim( $gender ) != '' &&
            trim( $dob ) != ''
        ) {
            $query = "insert into Users(Name, Surname, Email, Username, Password, Gender, DOB) values('$name','$surname', '$email', '$username', '$password', '$gender', '$dob')"; #query to insert into users table all the values from the input of the user

            if ( strlen( $password ) < 8 ) { #checks if the password entered is smaller than 8 characters
                $showPassMessage = true; #if it is smaller than 8 then it makes the error message variable true
            } elseif (!mysqli_query($db, $query)){ #checks if the execution of the query has failed, if it failed it will show an error
                    $error = mysqli_error($db);
                    if ($error == "Duplicate entry '$email' for key 'Email'"){ #checks if the sql returns an error with the Duplicate key entered, this doesnt let the user enter the same email as someone elese in the database, then if it returns an error, it will display an error message
                        $emailExists = true;
                    }elseif ($error == "Duplicate entry '$username' for key 'Username'"){ #checks if the sql returns an error with the Duplicate key entered, this doesnt let the user enter the same username as someone elese in the database, then if it returns an error, it will display an error message
                        $usernameExists = true;
                    }
            }else{#if neither of the above conditions are satisfied, then it will simply redirect the user to the login page, so he/she can enter the credentials again
                header("Location: login.php");
            }
            
        } else { #if the above statement is not met, then it will show a message to enter all the fields
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

            <?php if ( $showErrorMessage ): #checks if the error message is true, if it is then the below elements will be displayed?>
            <div class="show-error">
                <strong>
                    <p>Please fill all the fields.</p>
                </strong>
            </div>
            <?php endif #ends the above if condition for the error message?>
            <?php if ( $showPassMessage ): #checks if the error message is true, if it is then the below elements will be displayed?>
            <div class="show-error">
                <strong>
                    <p>Password should be more than 8 characters.</p>
                </strong>
            </div>
            <?php endif #ends the above if condition for the error message?>
            <?php if ( $emailExists ): #checks if the error message is true, if it is then the below elements will be displayed?>
            <div class="show-error">
                <strong>
                    <p>Email already exists.</p>
                </strong>
            </div>
            <?php endif #ends the above if condition for the error message?>
            <?php if ( $usernameExists ): #checks if the error message is true, if it is then the below elements will be displayed?>
            <div class="show-error">
                <strong>
                    <p>Username already exists.</p>
                </strong>
            </div>
            <?php endif #ends the above if condition for the error message?>

            <div class="forms">
                <input type="text" name="name" id="name" placeholder="Name" value="<?php echo isset( $_POST['name'] ) ? $name : '' ?>">
            </div>

            <div class="forms">
                <input type="text" name="surname" placeholder="Surname" id="surname"
                    value="<?php echo isset( $_POST['surname'] ) ? $surname : '' #this is used to fill in the field with the same values as the user has entered, so when the page refreshes it will not lose all the data?>">
            </div>

            <div class="forms">
                <input type="email" name="email" placeholder="Email" id="email"
                    value="<?php echo isset( $_POST['email'] ) ? $email : '' #this is used to fill in the field with the same values as the user has entered, so when the page refreshes it will not lose all the data?>">
            </div>
            

            <div class="forms">
                <input class="username" type="text" name="username" placeholder="Username" id="username"
                    value="<?php echo isset( $_POST['username'] ) ? $username : '' #this is used to fill in the field with the same values as the user has entered, so when the page refreshes it will not lose all the data?>">
            </div>

            

            <div class="forms">
                <input type="password" name="password" placeholder="Password" id="password"
                    value="<?php echo isset( $_POST['password'] ) ? $password : '' #this is used to fill in the field with the same values as the user has entered, so when the page refreshes it will not lose all the data?>">
            </div>

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
                <input type="date" name="dob" id="dateofbirth" value="<?php echo isset( $_POST['dob'] ) ? $dob : '' #this is used to fill in the field with the same values as the user has entered, so when the page refreshes it will not lose all the data?>">
            </div>
            <input class="signup-button" name="submit" type="submit" value="Sign Up">
        </form>
    </div>
</body>
</html>
