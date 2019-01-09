<?php

// This is where the user can update info such as image, bio, password and email.
 require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Update user info</h1>

    <!-- Display error messages here -->

    <form action="app/users/update-V2.php" method="post">

        <!-- Profile picture -->
        <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" name="image" accept=".jpg, .jpeg, .png" value="<?= $loggedInUser['profile_image_url'];?>">
            <small class="form-text text-muted">Please insert your profile picture here. Please use following file
                formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Biography -->
        <div class="form-group">
            <label for="email">Biography</label>
            <input class="form-control" type="bio" name="bio" value="<?= $loggedInUser['bio'];?>">
            <small class="form-text text-muted">Write something about yourself.</small>
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@email.com" value="<?= $loggedInUser['email'];?>"
                required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Current Password</label>
            <input class="form-control" type="password" name="current-password">
            <small class="form-text text-muted">Please provide your old password.</small>
        </div>
        <!-- New password -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input class="form-control" type="password" name="new-password">
            <small class="form-text text-muted">Please provide your new password.</small>
        </div>
        <!-- Confirm password -->
        <div class="form-group">
            <label for="password">New Password</label>
            <input class="form-control" type="password" name="password-control">
            <small class="form-text text-muted">Please provide your new password again.</small>
        </div>
        <!-- Name -->
        <div class="form-group">
            <label for="first-name">Name</label>
            <input class="form-control" type="first-name" name="name" value="<?= $loggedInUser['name'];?>" disabled>
            <small class="form-text text-muted">Please provide your first name.</small>
        </div>
        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" value="<?= $loggedInUser['username'];?>"
                disabled>
            <small class="form-text text-muted">Please provide your username of choice.</small>
        </div>
        <!-- Submit-button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>