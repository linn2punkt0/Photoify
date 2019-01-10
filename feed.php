<?php 
$posts = getAllPosts();
// This is where the user can watcha feed of all the latest posts, from all users.
?>

<?php 
    foreach ($posts as $post) : 
    ?>
<div class="post">
    <img class="post-image" src="<?= $post['image_url']?>" alt="image">
    <h4>
        <?= $post['description']?>
    </h4>
    <h6>
        <?= date('d/m/Y', $post['date']);?>
    </h6>
    <h6 class="likes">Likes: 0</h6>
    <h6 class="dislikes">Dislikes: 0</h6>
    <div>
        <button class="like-button">Like</button>
        <button class="dislike-button">Dislike</button>
    </div>
</div>
<?php endforeach ?>