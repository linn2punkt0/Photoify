<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.
$errors = [];

// Check if email and password is submitted
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Fetch user by submitted email
    $user = getUserByEmail($email);

    // If user is found
    if ($user) {
        $hash = $user['password'];
        // Check if correct password is submitted
        if (password_verify($_POST['password'], $hash)) {
            $_SESSION['user'] = $user['id'];
            redirect('../../index.php');
        }
        // If incorrect password, redirect and echo errors
        else {
            $errors[] = "Incorrect password, try again!";
            $_SESSION['errors'] = $errors;
            redirect('/login-page.php');
        }
    }
    // If user is not found
    else {
        $errors[] = "User does not exist, tro another email adress.";
        $_SESSION['errors'] = $errors;
        redirect('/login-page.php');
    }
}
// If email and password is not submitted
else {
    $errors[] = "Submit email and password to login";
    $_SESSION['errors'] = $errors;
    redirect('/login-page.php');
}
