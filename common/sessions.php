<?php

session_start();

if ( isset( $_SESSION['user'] ) ) {
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
}else{
    $user = null;
}
?>