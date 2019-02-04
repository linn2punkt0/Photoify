<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$postId = $_POST['post-id'];
$userId = $loggedInUser['id'];

// Fetch all dislikes from current post_id
$dislikes = getDislikes($postId);

// Check if user is logged in, if so, proceed
if ($loggedInUser) {

// If dislikes exist, foreach dislike, check if user_id is loggedInUser
    if (!empty($dislikes)) {
        foreach ($dislikes as $dislike) {

        // If so, remove dislike from post
            if ($dislike['user_id'] === $userId) {
                removeDislikes($postId, $userId);
                redirect("../../index.php");
            }
            // If not, add dislike to post
            else {
                addDislikes($postId, $userId);
                redirect("../../index.php");
            }
        }
    }
    // If dislikes does not exist, add dislike
    else {
        addDislikes($postId, $userId);
        redirect("../../index.php");
    }
}

// If not logged in, redirect back to index.
else {
    redirect("../../index.php");
}
