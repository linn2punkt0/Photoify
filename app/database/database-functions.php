<?php
declare(strict_types=1);

// Setup the database connection.
function connectToDB(){
    static $pdo;
    if ($pdo instanceof PDO) {
        return $pdo;
    }
    // Fetch the global configuration array.
    $config = require dirname(__DIR__).'/config.php';
    // Setup database connection
    $pdo = new PDO($config['database_path']);
    return $pdo;
}


// USER FUNCTIONS

// Fetch user info from logged in user
function getUser($userId){
    $pdo = connectToDB();
    $statement = $pdo->prepare('SELECT id, name, email, profile_image_url, username, bio FROM users WHERE id = :id');
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
    $addNewUser = $pdo->prepare('INSERT INTO users (name, email, username, password) VALUES (:fullname, :email, :username, :hashedPassword)');
    if (!$addNewUser) {
        die(var_dump($pdo->errorInfo()));
    }
    $addNewUser->bindParam(':fullname', $fullName, PDO::PARAM_STR);
    $addNewUser->bindParam(':email', $email, PDO::PARAM_STR);
    $addNewUser->bindParam(':username', $username, PDO::PARAM_STR);
    $addNewUser->bindParam(':hashedPassword', $password, PDO::PARAM_STR);
    $addNewUser->execute();
}

// Update user
function updateUser($email, $image, $biography, $password, $id){
    $pdo = connectToDB();
    $updateUser = $pdo->prepare('UPDATE users SET email=:email, password=:password, profile_image_url=:profilePic, bio=:bio WHERE id=:id');
    if (!$updateUser) {
        die(var_dump($pdo->errorInfo()));
    }
    $updateUser->bindParam(':email', $email, PDO::PARAM_STR);
    $updateUser->bindParam(':profilePic', $image, PDO::PARAM_STR);
    $updateUser->bindParam(':bio', $biography, PDO::PARAM_STR);
    $updateUser->bindParam(':password', $password, PDO::PARAM_STR);
    $updateUser->bindParam(':id', $id, PDO::PARAM_INT);
    $updateUser->execute();
}

// PASSWORD FUNCTIONS

// Fetch password by user id
function getPassword($userId){
    $pdo = connectToDB();
    $getPassword = $pdo->prepare('SELECT password FROM users WHERE id = :id');
    if (!$getPassword) {
        die(var_dump($pdo->errorInfo()));
    }
    $getPassword->bindParam(':id', $userId, PDO::PARAM_INT);
    $getPassword->execute();
    $password = $getPassword->fetch(PDO::FETCH_ASSOC);
    return $password['password'];
}

//  POST FUNCTIONS

// Store new post
function newPost($description, $url, $loggedInUser){
    $pdo = connectToDB();
      $addNewPost = $pdo->prepare('INSERT INTO posts (description, image_url, user_id, date) VALUES (:description, :image_url, :user, :post_date)');
      if (!$addNewPost) {
          die(var_dump($pdo->errorInfo()));
      }
      $postDate =
      $addNewPost->bindParam(':description', $description, PDO::PARAM_STR);
      $addNewPost->bindParam(':image_url', $url, PDO::PARAM_STR);
      $addNewPost->bindParam(':user', $loggedInUser['id'], PDO::PARAM_INT);
      $addNewPost->bindParam(':post_date', time(), PDO::PARAM_STR);
      $addNewPost->execute();
      $newPost = $addNewPost->fetch(PDO::FETCH_ASSOC);
}

// Fetch posts from logged in user
function getMyPosts($user){
    $pdo = connectToDB();
    $myPostsStatement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user ORDER BY date DESC');
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
   $allPostsStatement = $pdo->prepare('SELECT * FROM posts ORDER BY date DESC');
   if (!$allPostsStatement) {
       die(var_dump($pdo->errorInfo()));
   }
   $allPostsStatement->execute();
   $allPosts = $allPostsStatement->fetchAll(PDO::FETCH_ASSOC);
   return $allPosts;
}

// Update post
function updatePost($description, $image, $postId){
    $pdo = connectToDB();
    $updatePost = $pdo->prepare('UPDATE posts SET description=:description, image_url=:image_url, date=:date WHERE post_id=:post_id');
    if (!$updatePost) {
        die(var_dump($pdo->errorInfo()));
    }
    $updatePost->bindParam(':description', $description, PDO::PARAM_STR);
    $updatePost->bindParam(':image_url', $image, PDO::PARAM_STR);
    $updatePost->bindParam(':date', time(), PDO::PARAM_STR);
    $updatePost->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $updatePost->execute();
    // Not tested function, also, remember to reload posts with other function
}

// Delete post
function deletePost($postId){
    $pdo = connectToDB();
    $deletePost = $pdo->prepare('DELETE FROM posts WHERE post_id=:post_id');
    if (!$deletePost) {
        die(var_dump($pdo->errorInfo()));
    }
    $deletePost->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $deletePost->execute();
    // Not tested function, also, remember to reload posts with other function

}

// LIKE FUNCTIONS