<?php

declare(strict_types=1);

// Start the session engines.
session_start();

// Set the default timezone to Coordinated Universal Time.
date_default_timezone_set('UTC');

// Set the default character encoding to UTF-8.
mb_internal_encoding('UTF-8');

// Include the helper functions.
require __DIR__.'/functions.php';

// Fetch the global configuration array.
$config = require __DIR__.'/config.php';

// Setup the database connection.
$pdo = new PDO($config['database_path']);

// Fetch info and posts from logged in user from database
$loggedInUser = null;
$myPosts = null;

// Fetch info from database if user is logged in
if (isset($_SESSION['user'])) {

    // Fetch user info
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $id = $_SESSION['user'];
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $loggedInUser = $statement->fetch(PDO::FETCH_ASSOC);

    // Fetch posts from logged in user
    $myPostsStatement = $pdo->prepare('SELECT * FROM posts WHERE "user_id" = :user');
    if (!$myPostsStatement) {
        die(var_dump($pdo->errorInfo()));
    }
    $user = $loggedInUser['id'];
    $myPostsStatement->bindParam(':user', $user, PDO::PARAM_INT);
    $myPostsStatement->execute();
    $myPosts = $myPostsStatement->fetchAll(PDO::FETCH_ASSOC);
}

   // Fetch all posts
   $allPostsStatement = $pdo->prepare('SELECT * FROM posts');
   if (!$allPostsStatement) {
       die(var_dump($pdo->errorInfo()));
   }
   $allPostsStatement->execute();
   $allPosts = $allPostsStatement->fetchAll(PDO::FETCH_ASSOC);