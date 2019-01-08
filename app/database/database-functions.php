<?php
declare(strict_types=1);

// Setup the database connection.
function connectToDB(){
    // Fetch the global configuration array.
    $config = require dirname(__DIR__).'/config.php';
    // Setup database connection
    $pdo = new PDO($config['database_path']);
    return $pdo;
}



// Fetch user info from logged in user
function getUser($userId){
    $pdo = connectToDB();
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        return null;
    }
    return $user;
}

// Fetch posts from logged in user
function getMyPosts($user){
    $pdo = connectToDB();
    $myPostsStatement = $pdo->prepare('SELECT * FROM posts WHERE "user_id" = :user ORDER BY "date" DESC');
    if (!$myPostsStatement) {
        die(var_dump($pdo->errorInfo()));
    }
    $myPostsStatement->bindParam(':user', $user, PDO::PARAM_INT);
    $myPostsStatement->execute();
    $myPosts = $myPostsStatement->fetchAll(PDO::FETCH_ASSOC);
    return $myPosts;
}

// Fetch all posts
function getAllPosts(){
    $pdo = connectToDB();
   $allPostsStatement = $pdo->prepare('SELECT * FROM posts ORDER BY "date" DESC');
   if (!$allPostsStatement) {
       die(var_dump($pdo->errorInfo()));
   }
   $allPostsStatement->execute();
   $allPosts = $allPostsStatement->fetchAll(PDO::FETCH_ASSOC);
   return $allPosts;
}

// Fetch user by submitted email to see if email already exists
function getUserByEmail($email){
    $pdo = connectToDB();
    $checkForEmail = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    if (!$checkForEmail) {
        die(var_dump($pdo->errorInfo()));
    }
    $checkForEmail->bindParam(':email', $email, PDO::PARAM_STR);
    $checkForEmail->execute();
    $user = $checkForEmail->fetch(PDO::FETCH_ASSOC);
    return $user;
}

 // Fetch user by submitted username
 function getUserByUsername($username){
    $pdo = connectToDB();
    $checkForUsername = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    if (!$checkForUsername) {
        die(var_dump($pdo->errorInfo()));
    }
    $checkForUsername->bindParam(':username', $username, PDO::PARAM_STR);
    $checkForUsername->execute();
    $user = $checkForUsername->fetch(PDO::FETCH_ASSOC);
    return $user;
}

// Register new user
function registerUser($fullName, $email, $username, $password){
    $pdo = connectToDB();
    $addNewUser = $pdo->prepare('INSERT INTO users ("name", email, username, "password") VALUES (:fullname, :email, :username, :hashedPassword)');
    if (!$addNewUser) {
        die(var_dump($pdo->errorInfo()));
    }
    $addNewUser->bindParam(':fullname', $fullName, PDO::PARAM_STR);
    $addNewUser->bindParam(':email', $email, PDO::PARAM_STR);
    $addNewUser->bindParam(':username', $username, PDO::PARAM_STR);
    $addNewUser->bindParam(':hashedPassword', $password, PDO::PARAM_STR);
    $addNewUser->execute();
    $newUser = $addNewUser->fetch(PDO::FETCH_ASSOC);
    return $newUser;
}