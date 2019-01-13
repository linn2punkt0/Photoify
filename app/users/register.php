<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we register users.

// Check if all fields are submitted and sanitize them
if (isset($_POST['first-name'], $_POST['last-name'], $_POST['email'], $_POST['username'], $_POST['password'], $_POST['password-control'] )) {
    $firstName = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
    $fullName = $firstName . " " . $lastName;
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if email or username already exists and if password and password-control are the same

    // Fetch user by submitted email
   $userByEmail = getUserByEmail($email);

   $userByUsername = getUserByUsername($username);

    // If email or username already exists, or if passwords do not match, add message to errors array.
    $errors = [];
    if ($userByEmail) {
        $errors [] = "Email already exists!";
    }
    if ($userByUsername) {
        $errors [] =  "Username already exists!";
    }
    if ($_POST['password'] !== $_POST['password-control']) {
        $errors [] = "Passwords did not match!";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        redirect("../../register-page.php");
    }
    // If not, proceed with registration and add all input to database
    else {
        registerUser($fullName, $email, $username, $password);
        $user = getUserByEmail($email);
      
        //Keep new user logged in
        $_SESSION['user'] = $user['id'];
        redirect('../../index.php');
    } 
}

// If user forgot to provide information to all input fields
else {
    $errors [] = "Please fill in all input fields";
    $_SESSION['errors'] = $errors;
    redirect("../../register-page.php");
}