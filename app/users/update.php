<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we register users.

$errors = [];

// Check if current password is submitted
if ($_POST['current-password']) {
    
// Check if submitted password matches database
    if(password_verify($_POST['current-password'], $loggedInUser['password'])){

// Check if image is submitted
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];

    // Check if image is correct file type, if not, store error message
        if (!in_array($image['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            $errors[] = 'The uploaded file type is not allowed.';
        }

    // Check if image is correct size, if not, store error message
        if ($image['size'] > 2097152) {
            $errors[] = 'The uploaded file exceeded the filesize limit.';
        }
    }
    
    // Check if the errors any contains any errors concerning the image, if not, continue
        if (count($errors) === 0) {

        // Sanitize all fields
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $biography = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
            $password = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
            $id = $loggedInUser['id'];

        // Fetch user by submitted email to see if email already exists
            $checkForEmail = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            if (!$checkForEmail) {
                die(var_dump($pdo->errorInfo()));
            }
            $checkForEmail->bindParam(':email', $email, PDO::PARAM_STR);
            $checkForEmail->execute();
            $notNewEmail = $checkForEmail->fetch(PDO::FETCH_ASSOC);

        // If email exists in other account, or if passwords do not match, add message to errors array.
            if ($notNewEmail && !$id) {
                $errors [] = "Email is used by other account!";
            }
            if ($_POST['new-password'] !== $_POST['password-control']) {
                $errors [] = "New passwords did not match, try again!";
            }
        // If new passwords match, save the new password
            else {
                $newPassword = $_POST['new-password'];
            }
            
        // Check if the errors any contains any errors, if not, continue
            if (count($errors) === 0) {

                $updateUser = $pdo->prepare('UPDATE users (email, "password", profile_image_url, biography) VALUES (:email, :newPassword, :profilePic, :bio) WHERE id = :id');
                if (!$updateUser) {
                    die(var_dump($pdo->errorInfo()));
                }

                $updateUser->bindParam(':email', $email, PDO::PARAM_STR);
                $updateUser->bindParam(':profilePic', $image, PDO::PARAM_STR);
                $updateUser->bindParam(':bio', $biography, PDO::PARAM_STR);
                $updateUser->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
                $updateUser->bindParam(':id', $id, PDO::PARAM_INT);
                $updateUser->execute();
                $updatedUser = $updateUser->fetch(PDO::FETCH_ASSOC);
            } 
            // If errors is not empty (email or password-errors)
            else {
                foreach ($errors as $error) {
                    echo $error . "<br>";
            }
}
}
        // If errors is not empty (image-errors)
        else {
            foreach ($errors as $error) {
                echo $error . "<br>";
        }
    }
}
 // If password is incorrect
 else{
    $errors [] = "Incorrect password, try again!";
}
}
// If password is not submitted
else {
    $errors [] = "You must submit your password to make these changes.";
}
// If there are an errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}