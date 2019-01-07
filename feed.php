<?php 

require __DIR__.'/views/header.php'; 

// This is where the user can watch the feed of posts from people he follows.
// Add a functions file to this.
?>

<div class="all-posts">

    <?php 
    
    foreach ($allPosts as $post) : 
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

<?php require __DIR__.'/views/footer.php'; ?>