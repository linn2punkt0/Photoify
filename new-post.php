<?php require __DIR__.'/views/header.php'; 

// This is where the user can adde new posts.
?>

<article>
    <h1>Create new post</h1>

    <!-- Display error messages here -->

    <form action="app/posts/store.php" method="post" enctype="multipart/form-data">
        <!-- Image -->
        <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" name="image" accept=".jpg, .jpeg, .png" required>
            <small class="form-text text-muted">Please insert your image here. Please use following file formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <input class="form-control" type="text" name="description" placeholder="Write your description here">
        </div>
        <!-- Post-button -->
        <button type="submit" class="btn btn-primary">Post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>