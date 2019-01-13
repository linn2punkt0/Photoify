<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

    <!-- Display error messages here -->

    <form action="app/users/login.php" method="post">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="email@email.com" required>
            <small>Please provide the your email address.</small>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <small>Please provide the your password (passphrase).</small>
        </div>
        <!-- Login-button -->
        <button type="submit">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>