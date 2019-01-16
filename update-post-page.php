<?php require __DIR__.'/views/header.php'; 

$postId = $_GET['postId'];
$post = getThisPost($postId);
// This is where the user can update their posts or delet them
?>

<article class="update-page update-post">
    <h1>Update or delete your post</h1>

    <!-- Display error messages here -->
    <p class="errors">
        <?php if (isset($_SESSION['errors'])) {
        $errors = $_SESSION['errors'];
        foreach ($errors as $error) {
            echo $error;
        }
        unset($_SESSION['errors']);
    }
    ?>
    </p>

    <!-- Update post -->
    <form action="app/posts/update.php" method="post" enctype="multipart/form-data">
        <!-- Image -->
        <h4>Current image</h4>
        <img src="<?= $post['image_url']?>" alt="">
        <div class=" form-group" class="image-wrapper">
            <input class="choose-file" type="file" name="new-image" accept=".jpg, .jpeg, .png" onchange="preview_image(event)">
            <h4>New image</h4>
            <img class="output_image" />
        </div>
        <!-- Description -->
        <div class="form-group">
            <h4>Description</h4>
            <textarea class="edit-description" rows="5" type="text" name="description"><?= $post['description']; ?></textarea>
        </div>
        <div class=update-buttons>
            <!-- Post-button -->
            <input type="hidden" name="id" value="<?= $post['post_id']?>">
            <button class="edit-button" type="submit"><img src="/assets/iconmonstr-save.png" alt="Save"></button>
    </form>

    <!-- Delete post -->
    <form action="app/posts/delete.php" method="post">
        <input type="hidden" name="id" value="<?= $post['post_id']?>">
        <button class="delete-button"><img src="/assets/iconmonstr-trash.png" alt="Delete"></button>
    </form>
    </div>
</article>

<?php require __DIR__.'/views/footer.php'; ?>