<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we update users.

// Here is all the current user info
$errors = [];
$id = $loggedInUser['id'];
$name = $loggedInUser['name'];
$password = getPassword($loggedInUser['id']);
$email = $loggedInUser['email'];
$image = $loggedInUser['profile_image_url'];
$biography = $loggedInUser['bio'];


// if (isset($_FILE['image'], $_POST['bio'], $_POST['email'], $_POST['current-password'], $_POST['new-password'], $_POST['password-control'], $_POST['name'], $_POST['username'])) {

// Check if current password is submitted, if not add error message, otherwise, continue
if (!isset($_POST['current-password'])) {
    $errors[] = "You must submit your password to make these changes.";
}
    
// Check if submitted password matches database, if not add error message, otherwise, continue
if(!password_verify($_POST['current-password'], $password)){
    $errors[] = "Incorrect password, try again!";
}

// Check if image is submitted
if (isset($_FILES['image'])) {
    $image = uploadImage($_FILES['image']);
}

// Check if the errors any contains any errors concerning the image, if not, continue
if (count($errors) === 0) {

    if (isset($_POST['bio'])) {
        $biography = filter_var($_POST['bio'], FILTER_SANITIZE_STRING);
    }
    
    // Sanitize all fields
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    // Fetch user my email
    $user = getUserByEmail($email);

    // If submitted email already exists in database, look if it's logged in user, or other user.
    if ($user) {
    
        // If email belongs to other user, add message to errors array
        if ($user['id'] !== $id) {
         $errors[] = "Email is used by other account!";
        }
        
    // If email belongs to logged in user, proceed and use email in update-statement
    }
    
    if (isset($_POST['new-password'])) {

        // If passwords do not match, add message to errors array
        if ($_POST['new-password'] !== $_POST['password-control']) {
            $errors[] = "New passwords did not match, try again!";
        }

        // If new passwords match, save the new password
        else {
            $password = password_hash($_POST['new-password'], PASSWORD_BCRYPT);
        }
    }
    
    // Check if the errors any contains any errors, if not, continue
    if (count($errors) === 0) {
    updateUser($email, $image, $biography, $password, $id);
    $updatedUser = getUserByEmail($email);
    
    // Redirect user to "My pages" to see their newly uploaded image           
    redirect('../../my-pages.php');
    }

    // If errors is not empty (email or password-errors)
    else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
} 
// }
// else {
//     echo "All fields have not been submitted!";
// }
    
// If there are an errors
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}