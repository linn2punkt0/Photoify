<?php require __DIR__.'/views/header.php'; ?>

<article class="update-page">
    <h1>Register</h1>

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

    <form action="app/users/register.php" method="post">
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="email@email.com" required>
        </div>
        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" required>
        </div>
        <!-- Password-control -->
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password-control" required>
        </div>
        <!-- First name -->
        <div class="form-group">
            <label for="first-name">First name</label>
            <input type="first-name" name="first-name" required>
        </div>
        <!-- Last name -->
        <div class="form-group">
            <label for="last-name">Last name</label>
            <input type="last-name" name="last-name" required>
        </div>
        <!-- Username -->
        <div class="form-group">
            <label for="username">Username</label>
            <input type="username" name="username" required>
        </div>
        <!-- Submit-button -->
        <button class="button" type="submit">Register</button>
    </form>
</article>

<?php require __DIR__.'/views/footer.php'; ?>