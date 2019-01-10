<?php 

require __DIR__.'/views/header.php'; 
$myPosts = getMyPosts($loggedInUser['id']);

// This is where the user can see all his post and userinfo .
?>

<div>
    <div class="user-info">
        <h1>My pages</h1>
        <img src="" alt="profile-pic">
        <h2>
            <?= $loggedInUser['name']?>
        </h2>
        <h3>
            <?= $loggedInUser['username']?>
        </h3>
    </div>
    <button><a href="/update-user-page.php">Update user info</a></button>

    <div class="my-posts">

        <?php 
        foreach ($myPosts as $myPost) : ?>
        <div>
            <img src="<?= $myPost['image_url']?>" alt="image">
            <h4>
                <?= $myPost['description']?>
            </h4>
            <h6>
                <?= date('d/m/Y', $myPost['date'])?>
            </h6>
            <h6 class="likes">Likes: 0</h6>
            <h6 class="dislikes">Dislikes: 0</h6>
        </div>
        <?php endforeach ?>
    </div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>