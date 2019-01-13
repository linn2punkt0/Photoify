<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete posts in the database.

$errors = [];

// First check which user ID belongs to thw creator of this post
$thisPost = getThisPost($_POST['id']);
$image = $thisPost['image_url'];
$description = $thisPost['description'];
$postId = $thisPost['post_id'];
$userId = $thisPost['user_id'];



// If it's the same as the logged in user, proceed to delete post
if ($loggedInUser['id'] === $userId) {

    // Check if image is submitted
    if (!empty($_FILES['new-image'])) {
        // Check if image is correct file type, if not, store error message
        if (!in_array($_FILES['new-mage']['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
            $errors[] = 'The uploaded file type is not allowed.';
        }

        // Check if image is correct size, if not, store error message
        if ($_FILES['new-image']['size'] > 2097152) {
            $errors[] = 'The uploaded file exceeded the filesize limit.';
        }
        // If there are no errors, continue
        if (count($errors) === 0) {
            $image = uploadImage($_FILES['new–image']);
        }
        
        else {
            $_SESSION['errors'] = $errors;
        }
    }
    if(isset($_POST['description'])){
        $description = $_POST['description'];
    }

    updatePost($description, $image, $postId);
    redirect('../../my-pages.php');
}
// If not correct user, echo message to user
else {
    $errors[] = "You can only update your own posts!";
    $_SESSION['errors'] = $errors;
}

// redirect('/');