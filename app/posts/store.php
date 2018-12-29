<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we store/insert new posts in the database.
$errors = [];
// Check if email and password is submitted
    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        // We only want to allow the .png and .jpg files. We can compare the mime type
        // attribute for each uploaded file. Please visit this link to see a full
        // list of MIME types: https://www.sitepoint.com/mime-types-complete-list
        if (!in_array($image['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            $errors[] = 'The uploaded file type is not allowed.';
        }
        // We only want to allow file sizes equal to or lower than two megabytes.
        // 2 Megabyte = 2097152 Bytes
        if ($image['size'] > 2097152) {
            $errors[] = 'The uploaded file exceeded the filesize limit.';
        }
        // If there are any errors in the array we should't upload the file.
        if (count($errors) === 0) {
            $destination = __DIR__.'../uploads/'.$image['name'];
            // Using the move_uploaded_file function we can upload files from the
            // temporary path to a new destination. Remember to specify the full
            // path to where PHP should save the file on your system.
            move_uploaded_file($image['tmp_name'], $destination);
            // If everything went well, display a success message to the user.
            $message = 'The file was successfully uploaded!';
            $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
            $addNewPost = $pdo->prepare('INSERT INTO posts ("description", "image_url", "user_id") VALUES (:description, :image_url, :user)');
            if (!$addNewPost) {
                die(var_dump($pdo->errorInfo()));
            }
            die(var_dump($image));
            $url = '/uploads/'.$image['name'];
            $addNewPost->bindParam(':description', $description, PDO::PARAM_STR);
            $addNewPost->bindParam(':image_url', $url, PDO::PARAM_STR);
            $addNewPost->bindParam(':user', $loggedInUser['id'], PDO::PARAM_INT);
            $addNewPost->execute();
            $newPost = $addNewPost->fetch(PDO::FETCH_ASSOC);
            
            redirect('../../my-pages.php');
        }
        else {
            foreach ($errors as $error) {
                echo $error;
            }
        }
       
    }
    
   

/* redirect('/index.php'); */
