<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
$errors = [];

// Check if image is submitted
    if (isset($_FILES['image'])) {

       $url = uploadImage($_FILES['image']);
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
            foreach ($errors as $error) {
                echo $error;
            }
        }
       
    }
    
   

/* redirect('/index.php'); */