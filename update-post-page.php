<?php require __DIR__.'/views/header.php'; 

// This is where the user can update their posts or delet them
?>

<article>
    <h1>Update or delete your post</h1>

    <!-- Display error messages here -->


    <!-- Update post -->
    <form action="app/posts/update.php" method="post" enctype="multipart/form-data">
        <!-- Image -->
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" accept=".jpg, .jpeg, .png" required>
            <small>Please insert your image here. Please use following file formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Description -->
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" placeholder="Write your description here">
        </div>
        <!-- Post-button -->
        <button type="submit">Update post</button>
    </form>

    <!-- Delete post -->
    <form action="app/posts/delete.php">
        <button>Delete post</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>