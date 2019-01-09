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

function uploadImage($formInput){
    $image = $formInput;
    $errors = [];

    // Check if image is correct file type, if not, store error message
    if (!in_array($image['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
        $errors[] = 'The uploaded file type is not allowed.';
    }

    // Check if image is correct size, if not, store error message
    if ($image['size'] > 2097152) {
        $errors[] = 'The uploaded file exceeded the filesize limit.';
    }

    // If there are no errors, continue
    if (count($errors) === 0) {
        
        // Set destination for all images
        $destination = dirname(dirname(__DIR__)).'/uploads/'.$image['name'];

        // Move file from tmp-folder to chosen destination
        move_uploaded_file($image['tmp_name'], $destination);

        // Return path to image
        $url = '/uploads/'.$image['name'];
        return $url;
    }
    
    else {
        return $errors;
    }
}
?>