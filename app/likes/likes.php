<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$postId = $_POST['post-id'];
$userId = $loggedInUser['id'];

// Fetch all likes from current post_id
$likes = getLikes($postId);

// Check if user is logged in, if so, proceed
if ($loggedInUser){
    
// If likes exist, foreach like, check if user_id is loggedInUser
if (!empty($likes)) {
   
    foreach ($likes as $like) {

        // If so, remove like from post
        if ($like['user_id'] === $userId) {
            removeLikes($postId, $userId);
            redirect("../../index.php");
        }
        // If not, add like to post
        else {
            addLikes($postId, $userId);
            redirect("../../index.php");
        }
    }
}
// If likes does not exist, add dislike
else {
    addLikes($postId, $userId);
    redirect("../../index.php");
}
}
// If not logged in, redirect back to index.
else {
    redirect("../../index.php");
}