<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$postId = $_POST['post-id'];
$userId = $loggedInUser['id'];

// Fetch all likes from current post_id
$likes = getLikes($postId);

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
else {
    addLikes($postId, $userId);
    redirect("../../index.php");
}