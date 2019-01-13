<?php 

require __DIR__.'/views/header.php'; 
$myPosts = getMyPosts($loggedInUser['id']);

// This is where the user can see all his post and userinfo .
?>

<div>
    <div class="user-info">
        <h1>My pages</h1>
        <img class="profile-pic" src="<?= $loggedInUser['profile_image_url']?>" alt="profile-pic">
        <h2>
            <?= $loggedInUser['name']?>
        </h2>
        <h3>
            <?= $loggedInUser['username']?>
        </h3>
        <h4>
            <?= $loggedInUser['bio']?>
        </h4>
    </div>
    <button><a href="/update-user-page.php">Update user info</a></button>

    <div class="post-feed">
        <?php 
        foreach ($myPosts as $myPost) : ?>
        <div class="post">
            <img class="post-image" src="<?= $myPost['image_url']?>" alt="image">
            <h5>
                <?= $myPost['description']?>
            </h5>
            <h6>
                <?=date('d/m/Y', $myPost['date'])?>
            </h6>
            <div class="likes-count">
                <h5 class="likes">Likes: 0</h5>
                <h5 class="dislikes">Dislikes: 0</h5>
            </div>
            <a href="<?= "/update-post-page.php?postId=".$myPost['post_id'];?>"> Edit or Delete post</a> </div> <?php
                endforeach ?>
        </div>
    </div>

    <?php require __DIR__.'/views/footer.php'; ?>