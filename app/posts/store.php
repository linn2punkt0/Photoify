<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
$errors = [];

// Check if image is submitted
if (isset($_FILES['image'])) {
    // Check if image is correct file type, if not, store error message
    if (!in_array($_FILES['image']['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
      $errors[] = 'The uploaded file type is not allowed.';
  }

  // Check if image is correct size, if not, store error message
  if ($_FILES['image']['size'] > 2097152) {
      $errors[] = 'The uploaded file exceeded the filesize limit, max 2MB.';
  }
    // If there are no errors, continue
    if (count($errors) === 0) {
     
  $url = uploadImage($_FILES['image']);
    }

    // Else redirect and echo errors
    else {
        $_SESSION['errors'] = $errors;
        redirect("../../new-post.php");
  }
}
       $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
       
// Check if the errors any contains any errors, if not, continue
        if (count($errors) === 0) {

    // Store image-url, description and user-id to database
         newPost($description, $url, $loggedInUser);
         
    // Redirect user to "My pages" to see their newly uploaded image           
            redirect('../../my-pages.php');
        }

// If there are errors, display them
        else {
            $_SESSION['errors'] = $errors;
            redirect("../../new-post.php");
        }