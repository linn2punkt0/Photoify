<?php
declare(strict_types=1);
require __DIR__.'/../autoload.php';

$postId = $_POST['post-id'];
$userId = $loggedInUser['id'];

//// This is the new way of adding/removing likes, to see the old way, go to dislikes.php, where the old way still works mysteriously. ////
// The new way uses checkIfLiked-function instead of getLikes-function

// Fetch all likes from current post_id
// $likes = getLikes($postId);

// Check if user is logged in, if so, proceed
if ($loggedInUser){

	// check if user already has liked post
	$alreadyLiked = checkIfLiked($userId, $postId);

	// If so, remove like
if ($alreadyLiked) {
	removeLikes($postId, $userId);
	redirect("../../index.php");
}
	// Otherwise, add like
else {
	addLikes($postId, $userId);
	redirect("../../index.php");
}
}
// If not logged in, redirect back to index.
else {
    redirect("../../index.php");
}