<?php 

require __DIR__.'/views/header.php'; 
$myPosts = getMyPosts($loggedInUser['id']);

// This is where the user can see all his post and userinfo .
?>

<div class="my-pages">
    <div class="user-info">
        <h1>My pages</h1>
        <img class="profile-pic" src="<?= $loggedInUser['profile_image_url']?>" alt="profile-pic">
        <h2>
            <?= $loggedInUser['name']?>
        </h2>
        <h3>
            <?= $loggedInUser['username']?>
        </h3>
        <h4 class="bio">
            <?= $loggedInUser['bio']?>
        </h4>
        <button class="user-update"><a href="/update-user-page.php">Update user info</a></button>
    </div>

    <div class="post-feed">
        <?php 
        foreach ($myPosts as $myPost) : 
            $likes = countLikes($myPost['post_id']);
            $dislikes = countDislikes($myPost['post_id']);?>
        <div class="post">
            <div class=image-container>
                <img class="post-image" src="<?= $myPost['image_url']?>" alt="image">
            </div>
            <h5 class="description">
                <?= $myPost['description']?>
            </h5>
            <div class="info-container">
                <h6 class="post-date">
                    <?=date('d/m/Y', $myPost['date'])?>
                </h6>
                <div class="like-buttons">
                    <form class="likes-form" action="/app/likes/likes.php" method="post">
                        <input type="hidden" name="post-id" value="<?=$post['post_id']; ?>">
                        <button class="like-button"><img src="<?= !empty($doesUserLikePost) ? "/assets/iconmonstr-thumb-like-dark.png"
                                : "/assets/iconmonstr-thumb-like-light.png" ?>" alt=""></button>
                        <h5 class="likes">
                            <?= !empty($likes) ?  $likes :  '0' ?>
                        </h5>
                    </form>
                    <form class="likes-form" action="/app/likes/dislikes.php" method="post">
                        <input type="hidden" name="post-id" value="<?=$post['post_id']; ?>">
                        <h5 class="dislikes">
                            <?= !empty($dislikes) ?  $dislikes :  '0' ?>
                        </h5>
                        <button class="dislike-button"><img src="<?= !empty($doesUserDislikePost) ? "/assets/iconmonstr-thumb-dislike-dark.png"
                                : "/assets/iconmonstr-thumb-dislike-light.png" ?>" alt=""></button>
                    </form>
                </div>
                <a class="edit-button" href="<?= "/update-post-page.php?postId=".$myPost['post_id'];?>"> <img src="/assets/iconmonstr-edit.png"
                    alt="Edit"></a>
            </div>
        </div>
        <?php
                endforeach ?>
    </div>
</div>

<?php require __DIR__.'/views/footer.php'; ?>