<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Login</h1>

<!-- Display error messages here -->

    <form action="app/users/login.php" method="post">
<!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@email.com" required>
            <small class="form-text text-muted">Please provide the your email address.</small>
        </div>
<!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide the your password (passphrase).</small>
        </div>
<!-- Login-button -->
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>