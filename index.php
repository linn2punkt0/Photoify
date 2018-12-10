<?php require __DIR__.'/views/header.php'; ?>

<h2><?php if(isset($_SESSION['user'])){echo "Welcome, " . $_SESSION['user']['name']. "!\n";} ?></h2>
    <p>This is the home page.</p>

<?php require __DIR__.'/views/footer.php'; ?>
