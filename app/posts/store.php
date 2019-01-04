<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
$errors = [];

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

// Check if the errors any contains any errors, if not, continue
        if (count($errors) === 0) {

    // Set destination for all images
            $destination = dirname(dirname(__DIR__)).'/uploads/'.$image['name'];

    // Move file from tmp-folder to chosen destination
            move_uploaded_file($image['tmp_name'], $destination);

    // Store image-url, description and user-id to database
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $addNewPost = $pdo->prepare('INSERT INTO posts ("description", "image_url", "user_id") VALUES (:description, :image_url, :user)');
            if (!$addNewPost) {
                die(var_dump($pdo->errorInfo()));
            }
    
            $url = '/uploads/'.$image['name'];
            $addNewPost->bindParam(':description', $description, PDO::PARAM_STR);
            $addNewPost->bindParam(':image_url', $url, PDO::PARAM_STR);
            $addNewPost->bindParam(':user', $loggedInUser['id'], PDO::PARAM_INT);
            $addNewPost->execute();
            $newPost = $addNewPost->fetch(PDO::FETCH_ASSOC);

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
