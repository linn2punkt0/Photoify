<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.

// Check if email and password is submitted
if (isset($_POST['email'], $_POST['password'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Fetch user by submitted email
    $user = getUserByEmail($email);

    // If user is found
    if ($user) {
        $hash = $user['password'];
        if(password_verify($_POST['password'], $hash)){
            $_SESSION['user'] = $user['id'];
            redirect('../../index.php');
        }
        else {
            redirect('/login-page.php');
        }
    }
    // If user is not found
    else {
        redirect('/login-page.php');
    }
    
}
// If email and password is not submitted
redirect('../index.php');