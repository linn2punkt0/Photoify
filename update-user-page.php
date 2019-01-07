<?php

// This is where the user can update info such as image, bio, password and email.
// Add a functions file to this.
 require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Update user info</h1>

    <!-- Display error messages here -->

    <form action="app/users/register.php" method="post">
        <!-- Profile picture -->
        <div class="form-group">
            <label for="image">Image</label>
            <input class="form-control" type="file" name="image" accept=".jpg, .jpeg, .png">
            <small class="form-text text-muted">Please insert your image here. Please use following file formats: jpg,
                jpeg, png. Max filesize 2MB.</small>
        </div>
        <!-- Biography -->
        <div class="form-group">
            <label for="email">Biography</label>
            <input class="form-control" type="bio" name="bio">
            <small class="form-text text-muted">Write something about yourself.</small>
        </div>
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@email.com" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div>
        <!-- Password-control -->
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password-control" required>
            <small class="form-text text-muted">Please provide your password again.</small>
        </div>
        <!-- First name -->
        <div class="form-group">
            <label for="first-name">First name</label>
            <input class="form-control" type="first-name" name="first-name" required>
            <small class="form-text text-muted">Please provide your first name.</small>
        </div>
        <!-- Last name -->
        <div class="form-group">
            <label for="last-name">Last name</label>
            <input class="form-control" type="last-name" name="last-name" required>
            <small class="form-text text-muted">Please provide your last name.</small>
        </div>
        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required>
            <small class="form-text text-muted">Please provide your username of choice.</small>
        </div>
        <!-- Submit-button -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>