<?php

// This is where the user can update info such as image, bio, password and email.
 require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Update user info</h1>

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

    <form action="app/users/update.php" method="post" enctype="multipart/form-data">

        <!-- Profile picture -->
        <h4>Current image</h4>
        <img src="<?= $loggedInUser['profile_image_url']?>" alt="">
        <div class=" form-group" class="image-wrapper">
            <input type="file" name="new-image" accept=".jpg, .jpeg, .png" onchange="preview_image(event)">
            <h4>Choosen image</h4>
            <img class="output_image" />
            <small>Please insert your image here. Please use following file formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Biography -->
        <div class="form-group">
            <label for="email">Biography</label>
            <input type="bio" name="bio" value="<?= $loggedInUser['bio'];?>">
            <small>Write something about yourself.</small>
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="email@email.com" value="<?= $loggedInUser['email'];?>"
                required>
            <small>Please provide your email address.</small>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Current Password</label>
            <input type="password" name="current-password">
            <small>Please provide your current password.</small>
        </div>
        <!-- New password -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="new-password">
            <small>Please provide your new password.</small>
        </div>
        <!-- Confirm password -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" name="password-control">
            <small>Please provide your new password again.</small>
        </div>
        <!-- Name -->
        <div class="form-group">
            <label for="first-name">Name</label>
            <input type="first-name" name="name" value="<?= $loggedInUser['name'];?>" disabled>
            <small>Please provide your first name.</small>
        </div>
        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" name="username" value="<?= $loggedInUser['username'];?>" disabled>
            <small>Please provide your username of choice.</small>
        </div>
        <!-- Submit-button -->
        <button type="submit">Update</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>