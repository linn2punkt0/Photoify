<?php 

require __DIR__.'/views/header.php'; 
// This is where the user can see all his post and userinfo .
// Add a functions file to this.
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
    <button>
        Update user info
    </button>

    <div class="my-posts">

        <?php $posts = sortPosts($myPosts);
        foreach ($posts as $myPost) : ?>
        <div>
            <img src="<?= $myPost['image_url']?>" alt="image">
            <h4>
                <?= $myPost['description']?>
            </h4>
            <h6>
                <?= date('d/m/Y', $myPost['date'])?>
            </h6>
        </div>
        <?php endforeach ?>
    </div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>