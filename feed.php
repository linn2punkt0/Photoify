<?php 
$posts = getAllPosts();
// This is where the user can watcha feed of all the latest posts, from all users.
?>

<?php 
    foreach ($posts as $post) : 
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
        <h5 class="likes">Likes: 0</h5>
        <h5 class="dislikes">Dislikes: 0</h5>
    </div>
    <div>
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