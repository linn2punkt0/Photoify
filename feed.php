<?php 
$posts = getAllPosts();
// This is where the user can watcha feed of all the latest posts, from all users.
?>

<?php 
    foreach ($posts as $post) : 
        $likes = countLikes($post['post_id']);
        $dislikes = countDislikes($post['post_id']);
        $doesUserLikePost= userLikesPost($loggedInUser['id'], $post['post_id']);
        $doesUserDislikePost= userDislikesPost($loggedInUser['id'], $post['post_id']);
    ?>
<div class="post">
    <div class=image-container>
        <img class="post-image" src="<?= $post['image_url']?>" alt="image">
    </div>
    <h5 class="description">
        <?= $post['description']?>
    </h5>
    <div class="info-container">
        <h6>
            <?= date('d/m/Y', $post['date']);?>
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
    </div>
</div>
<?php endforeach ?>