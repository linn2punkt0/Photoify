<?php require __DIR__.'/views/header.php'; ?>

<h2>
    <?php if(isset($_SESSION['user'])){echo "You are logged in!\n";} ?>
</h2>

<p>This is the home page.</p>

<div class="post-feed">
    <?php require __DIR__.'/feed.php'; ?>
</div>

<?php require __DIR__.'/views/footer.php'; ?>