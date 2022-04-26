<?php

session_start(); #starts the session to use the variables on other files

if ( isset( $_SESSION['user'] ) ) { #checks if the users session is set after logging in, then assigns its corresponding variables to use them later
    $user = $_SESSION['user'];
    $id = $user['U_ID'];
    $name = $user['Name'];
    $surname = $user['Surname'];
    $email = $user['Email'];
    $username = $user['Username'];
    $password = $user['Password'];
    $gender = $user['Gender'];
    $dob = $user['DOB'];
    $role = $user['Admin']; 
}else{ #if the user doesnt exist then assign the user to null
    $user = null;
}
?>