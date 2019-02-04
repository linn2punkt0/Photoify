<?php require __DIR__.'/views/header.php';

// This is where the user can add new posts.
?>

<article class="update-page">
    <h1>Create new post</h1>

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

    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
        <!-- Image -->
        <div class=" form-group" class="image-wrapper">
            <input class="choose-file" type="file" name="image" accept=".jpg, .jpeg, .png" onchange="preview_image(event)"
                required>
            <h4>Choosen image</h4>
            <img class="output_image" />
        </div>
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="5" type="text" name="description" placeholder="Write your description here"></textarea>
        </div>
        <!-- Post-button -->
        <button class="button" type="submit">Post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>