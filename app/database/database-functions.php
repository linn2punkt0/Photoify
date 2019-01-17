<?php
declare(strict_types=1);

// Setup the database connection.
function connectToDB(): PDO {
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


///////////////////////////////////// USER FUNCTIONS /////////////////////////////////////

// Fetch user info from logged in user
function getUser(string $userId): array{
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
// FIX-RETURN-TYPE
function getUserByEmail(string $email){
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
 // FIX-RETURN-TYPE
 function getUserByUsername(string $username){
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
function registerUser(string $fullName, string $email, string $username, string $password, string $image): void{
    $pdo = connectToDB();
    $addNewUser = $pdo->prepare('INSERT INTO users (name, email, username, password, profile_image_url) VALUES (:fullname, :email, :username, :hashedPassword, :profile_image_url)');
    if (!$addNewUser) {
        die(var_dump($pdo->errorInfo()));
    }
    $addNewUser->bindParam(':fullname', $fullName, PDO::PARAM_STR);
    $addNewUser->bindParam(':email', $email, PDO::PARAM_STR);
    $addNewUser->bindParam(':username', $username, PDO::PARAM_STR);
    $addNewUser->bindParam(':hashedPassword', $password, PDO::PARAM_STR);
    $addNewUser->bindParam(':profile_image_url', $image, PDO::PARAM_STR);
    $addNewUser->execute();
}

// Update user
function updateUser(string $email, string $image, string $biography, string $password, string $id): void{
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

///////////////////////////////////// PASSWORD FUNCTIONS /////////////////////////////////////

// Fetch password by user id
function getPassword(string $userId): string{
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

///////////////////////////////////// POST FUNCTIONS /////////////////////////////////////

// Store new post
function newPost(string $description, string $url, array $loggedInUser): void{
    $pdo = connectToDB();
      $addNewPost = $pdo->prepare('INSERT INTO posts (description, image_url, user_id, date) VALUES (:description, :image_url, :user, :post_date)');
      if (!$addNewPost) {
          die(var_dump($pdo->errorInfo()));
      }
      $postDate = time();
      $addNewPost->bindParam(':description', $description, PDO::PARAM_STR);
      $addNewPost->bindParam(':image_url', $url, PDO::PARAM_STR);
      $addNewPost->bindParam(':user', $loggedInUser['id'], PDO::PARAM_INT);
      $addNewPost->bindParam(':post_date', $postDate, PDO::PARAM_STR);
      $addNewPost->execute();

}

// Fetch posts from logged in user
function getMyPosts(string $user): array{
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

// Fetch posts by post ID
function getThisPost(string $postId): array{
    $pdo = connectToDB();
    $thisPostStatement = $pdo->prepare('SELECT * FROM posts WHERE post_id = :post_id');
    if (!$thisPostStatement) {
        die(var_dump($pdo->errorInfo()));
    }
    $thisPostStatement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $thisPostStatement->execute();
    $thisPost = $thisPostStatement->fetch(PDO::FETCH_ASSOC);
    return $thisPost;
}

// Fetch all posts
function getAllPosts(): array{
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
function updatePost(string $description, string $image, string $postId): void{
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
}

// Delete post
function deletePost(string $postId): void{
    $pdo = connectToDB();
    $deletePost = $pdo->prepare('DELETE FROM posts WHERE post_id=:post_id');
    if (!$deletePost) {
        die(var_dump($pdo->errorInfo()));
    }
    $deletePost->bindParam(':post_id', $postId, PDO::PARAM_STR);
    $deletePost->execute();

}

///////////////////////////////////// LIKE FUNCTIONS /////////////////////////////////////

// New function to better check if user has liked post before or not
// This replaces "getLikes"
function checkIfLiked(string $userId, string $postId): bool{
	$pdo = connectToDB();
	$getLikes = $pdo->prepare('SELECT count(*) FROM likes WHERE post_id=:post_id and user_id=:user_id');
    if (!$getLikes) {
        die(var_dump($pdo->errorInfo()));
    }
	$getLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
	$getLikes->bindParam('user_id', $userId, PDO::PARAM_INT);
    $getLikes->execute();
	$likes = $getLikes->fetch(PDO::FETCH_NUM);
	if ($likes[0] === "0") {
		return false;
	}
	else {
		return true;
	}
	
}

// Fetch current likes by post ID - Replaced by "checkIfLiked"
// function getLikes(string$postId): array{
//     $pdo = connectToDB();
//     $getLikes = $pdo->prepare('SELECT * FROM likes WHERE post_id=:post_id');
//     if (!$getLikes) {
//         die(var_dump($pdo->errorInfo()));
//     }
//     $getLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
//     $getLikes->execute();
//     $likes = $getLikes->fetchAll(PDO::FETCH_ASSOC);
//     return $likes;

// }
// Fetch current likes by post ID and count them
function countLikes(string $postId): int{
    $pdo = connectToDB();
    $getLikes = $pdo->prepare('SELECT * FROM likes WHERE post_id=:post_id');
    if (!$getLikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $getLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $getLikes->execute();
    $likes = $getLikes->fetchAll(PDO::FETCH_ASSOC);
    $currentLikes = count($likes);
    return $currentLikes;

}

// Fetch current dislikes by post ID
function getDislikes(string $postId): array{
    $pdo = connectToDB();
    $getDislikes = $pdo->prepare('SELECT * FROM dislikes WHERE post_id=:post_id');
    if (!$getDislikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $getDislikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $getDislikes->execute();
    $likes = $getDislikes->fetchAll(PDO::FETCH_ASSOC);
    return $likes;

}
// Fetch current dislikes by post ID and count them
function countDislikes(string $postId):int{
    $pdo = connectToDB();
    $getDislikes = $pdo->prepare('SELECT * FROM dislikes WHERE post_id=:post_id');
    if (!$getDislikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $getDislikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $getDislikes->execute();
    $likes = $getDislikes->fetchAll(PDO::FETCH_ASSOC);
    $currentLikes = count($likes);
    return $currentLikes;

}

// Add likes to post
function addLikes(string $postId, string $userId): void{
    $pdo = connectToDB();
    $addLikes = $pdo->prepare('INSERT INTO likes (likes, post_id, user_id) VALUES (1, :post_id, :user_id)');
    if (!$addLikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $addLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $addLikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $addLikes->execute();
}

// Add dislikes to post
function addDislikes(string $postId, string $userId): void{
    $pdo = connectToDB();
    $addDislikes = $pdo->prepare('INSERT INTO dislikes (dislikes, post_id, user_id) VALUES (1, :post_id, :user_id)');
    if (!$addDislikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $addDislikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $addDislikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $addDislikes->execute();
}

// Remove likes from post
function removeLikes(string $postId, string $userId): void{
    $pdo = connectToDB();
    $removeLikes = $pdo->prepare('DELETE FROM likes WHERE user_id=:user_id AND post_id=:post_id');
    if (!$removeLikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $removeLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $removeLikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $removeLikes->execute();
}

// Remove dislikes from post
function removeDislikes(string $postId, string $userId): void{
    $pdo = connectToDB();
    $removeDislikes = $pdo->prepare('DELETE FROM dislikes WHERE user_id=:user_id AND post_id=:post_id ');
    if (!$removeDislikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $removeDislikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $removeDislikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $removeDislikes->execute();
}

// Check if user likes post
// FIX-RETURN-TYPE
function userLikesPost(string $userId, string $postId){
    $pdo = connectToDB();
    $getLikes = $pdo->prepare('SELECT * FROM likes WHERE user_id=:user_id AND post_id=:post_id ');
    if (!$getLikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $getLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $getLikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $getLikes->execute();
    $doesUserLikeThisPost = $getLikes->fetch(PDO::FETCH_ASSOC);
    return $doesUserLikeThisPost;
}

// Check if user dislikes post
// FIX-RETURN-TYPE
function userDislikesPost(string $userId, string $postId){
    $pdo = connectToDB();
    $getLikes = $pdo->prepare('SELECT * FROM dislikes WHERE user_id=:user_id AND post_id=:post_id ');
    if (!$getLikes) {
        die(var_dump($pdo->errorInfo()));
    }
    $getLikes->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $getLikes->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $getLikes->execute();
    $doesUserDislikeThisPost = $getLikes->fetch(PDO::FETCH_ASSOC);
    return $doesUserDislikeThisPost;
}