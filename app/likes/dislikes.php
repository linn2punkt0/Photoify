<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$postId = $_POST['post-id'];
$userId = $loggedInUser['id'];

// Fetch all likes from current post_id
$dislikes = getDislikes($postId);

// If likes exist, foreach like, check if user_id is loggedInUser
if (!empty($dislikes)) {
   
    foreach ($dislikes as $dislike) {

        // If so, remove like from post
        if ($dislike['user_id'] === $userId) {
            removeDislikes($postId, $userId);
            redirect("../../index.php");
        }
        // If not, add like to post
        else {
            addDislikes($postId, $userId);
            redirect("../../index.php");
        }
    }
}
else {
    addDislikes($postId, $userId);
    redirect("../../index.php");
}