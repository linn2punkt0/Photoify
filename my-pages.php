<?php require __DIR__.'/views/header.php'; 
// This is where the user can see all his post and userinfo .
// Add a functions file to this.
?>

<div>
    <h1>My pages</h1>
    <img src="" alt="profile-pic">
    <h2><?= $loggedInUser['name']?></h2>
    <h3><?= $loggedInUser['username']?></h3>


</div>

<?php require __DIR__.'/views/footer.php'; ?>