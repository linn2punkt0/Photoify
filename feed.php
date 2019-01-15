<?php 
$posts = getAllPosts();
// This is where the user can watcha feed of all the latest posts, from all users.
?>

<?php 
    foreach ($posts as $post) : 
        $likes = countLikes($post['post_id']);
        $dislikes = countDislikes($post['post_id']);
    ?>
<div class="post">
    <img class="post-image" src="<?= $post['image_url']?>" alt="image">
    <h5>
        <?= $post['description']?>
    </h5>
    <h6>
        <?= date('d/m/Y', $post['date']);?>
    </h6>
    <div class="likes-count">
        <h5 class="likes">Likes:
            <?= !empty($likes) ?  $likes :  '0' ?>
        </h5>
        <h5 class="dislikes">Dislikes:
            <?= !empty($dislikes) ?  $dislikes :  '0' ?>
        </h5>
    </div>
    <div class="like-buttons">
        <form class="likes-form" action="/app/likes/likes.php" method="post">
            <input type="hidden" name="post-id" value="<?=$post['post_id']; ?>">
            <button class="like-button">Like</button>
        </form>
        <form class="likes-form" action="/app/likes/dislikes.php" method="post">
            <input type="hidden" name="post-id" value="<?=$post['post_id']; ?>">
            <button class="dislike-button">Dislike</button>
        </form>
    </div>
</div>
<?php endforeach ?>