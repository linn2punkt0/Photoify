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
    $checkForEmail = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    if (!$checkForEmail) {
        die(var_dump($pdo->errorInfo()));
    }
    $checkForEmail->bindParam(':email', $email, PDO::PARAM_STR);
    $checkForEmail->execute();
    $notNewEmail = $checkForEmail->fetch(PDO::FETCH_ASSOC);

    // Fetch user by submitted username
    $checkForUsername = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    if (!$checkForUsername) {
        die(var_dump($pdo->errorInfo()));
    }
    $checkForUsername->bindParam(':username', $username, PDO::PARAM_STR);
    $checkForUsername->execute();
    $notNewUser = $checkForUsername->fetch(PDO::FETCH_ASSOC);

    // If email or username already exists, or if passwords do not match, add message to errors array.
    $errors = [];
    if ($notNewEmail) {
        $errors [] = "Email already exists!";
    }
    if ($notNewUser) {
        $errors [] =  "Username already exists!";
    }
    if ($_POST['password'] !== $_POST['password-control']) {
        $errors [] = "Passwords did not match!";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
    // If not, proceed with registration and add all input to database
    else {
        $addNewUser = $pdo->prepare('INSERT INTO users ("name", email, username, "password") VALUES (:fullname, :email, :username, :hashedPassword)');
        if (!$addNewUser) {
            die(var_dump($pdo->errorInfo()));
        }
        $addNewUser->bindParam(':fullname', $fullName, PDO::PARAM_STR);
        $addNewUser->bindParam(':email', $email, PDO::PARAM_STR);
        $addNewUser->bindParam(':username', $username, PDO::PARAM_STR);
        $addNewUser->bindParam(':hashedPassword', $password, PDO::PARAM_STR);
        $addNewUser->execute();
        $newUser = $addNewUser->fetch(PDO::FETCH_ASSOC);

        //Keep new user logged in
        $user = $newUser;
        $userInfo = ['user_id' => $user['id']];
        session_start();
        $_SESSION['user'] = $userInfo;
        redirect('../../index.php');
    } 
}
