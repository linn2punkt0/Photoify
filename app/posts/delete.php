<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we delete new posts in the database.
$errors = [];

// First check which user ID belongs to thw creator of this post
$thisPost = getThisPost($_POST['id']);

// If it's the same as the logged in user, proceed to delete post
if ($loggedInUser['id'] === $thisPost['user_id']) {
    deletePost($_POST['id']);
    redirect('../../my-pages.php');
}
// If not, echo message to user
else {
    $errors[] = "You can only delete your own posts!";
    $_SESSION['errors'] = $errors;
    redirect("../../update-post-page.php");
}
// redirect('/');
