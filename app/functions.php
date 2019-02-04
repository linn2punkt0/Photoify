<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

/**
 * Upload image
 *
 * @param array $formInput
 * @return string
 */
function uploadImage(array $formInput): string
{
    $image = $formInput;
   
    // Set destination for all images
    $destination = dirname(__DIR__).'/uploads/'.$image['name'];

    // Move file from tmp-folder to chosen destination
    move_uploaded_file($image['tmp_name'], $destination);

    // Return path to image
    $url = '/uploads/'.$image['name'];
    return $url;
}
