<?php
// Always start by loading the default application setup.
require __DIR__.'/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        <?php echo $config['title']; ?>
    </title>

    <link rel="stylesheet" href="./assets/styles/normalize.css">
    <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display|Roboto+Condensed:300,300i,400,400i,700,700i"
        rel="stylesheet">
    <link rel="stylesheet" href="./assets/styles/main.css">
</head>

<body>
    <?php require __DIR__.'/navigation.php'; ?>

    <div class="container">