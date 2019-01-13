<?php require __DIR__.'/views/header.php'; 

// This is where the user can add new posts.
?>

<article>
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
            <input type="file" name="image" accept=".jpg, .jpeg, .png" onchange="preview_image(event)" required>
            <h4>Choosen image</h4>
            <img class="output_image" />
            <small>Please insert your image here. Please use following file formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Write your description here">
        </div>
        <!-- Post-button -->
        <button type="submit">Post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>