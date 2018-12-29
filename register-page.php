<?php require __DIR__.'/views/header.php'; ?>

<article>
    <h1>Register</h1>

    <form action="app/users/register.php" method="post">
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" placeholder="email@email.com" required>
            <small class="form-text text-muted">Please provide your email address.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" required>
            <small class="form-text text-muted">Please provide your password.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password-control" required>
            <small class="form-text text-muted">Please provide your password again.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="first-name">First name</label>
            <input class="form-control" type="first-name" name="first-name" required>
            <small class="form-text text-muted">Please provide your first name.</small>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="last-name">Last name</label>
            <input class="form-control" type="last-name" name="last-name" required>
            <small class="form-text text-muted">Please provide your last name.</small>
        </div><!-- /form-group -->

          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="username" name="username" required>
            <small class="form-text text-muted">Please provide your username of choice.</small>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>