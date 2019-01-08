<?php 
$posts = getAllPosts();
// This is where the user can watcha feed of all the latest posts, from all users.
?>

<div class="all-posts">

    <?php 
    foreach ($posts as $post) : 
    ?>
    <div>
        <img src="<?= $post['image_url']?>" alt="image">
        <h4>
            <?= $post['description']?>
        </h4>
        <h6>
            <?= date('d/m/Y', $post['date']);?>
        </h6>
    </div>
    <?php endforeach ?>
</div>