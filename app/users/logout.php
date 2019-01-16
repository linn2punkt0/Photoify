<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we logout users.

// If Session is set, destroy it to log out user
if (isset($_SESSION['user'])) {
    session_destroy();
    redirect('../../index.php');
}