<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>

    <!-- Display error messages here -->

    <form action="app/users/register.php" method="post">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="email@email.com" required>
            <small>Please provide your email address.</small>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <small>Please provide your password.</small>
        </div>
        <!-- Password-control -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password-control" required>
            <small>Please provide your password again.</small>
        </div>
        <!-- First name -->
        <div class="form-group">
            <label for="first-name">First name</label>
            <input type="first-name" name="first-name" required>
            <small>Please provide your first name.</small>
        </div>
        <!-- Last name -->
        <div class="form-group">
            <label for="last-name">Last name</label>
            <input type="last-name" name="last-name" required>
            <small>Please provide your last name.</small>
        </div>
        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" name="username" required>
            <small>Please provide your username of choice.</small>
        </div>
        <!-- Submit-button -->
        <button type="submit">Register</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>