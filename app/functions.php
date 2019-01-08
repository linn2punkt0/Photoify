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
 * Compare timestamps in array
 *
 * @param array $time1
 * @param array $time2
 * @return integer
 */
function compareByTimeStamp(array $time1, array $time2) : int
{ 
    if ($time1 < $time2) 
        return 1; 
    else if ($time1 > $time2)  
        return -1; 
    else
        return 0; 
} 

/**
 * Sort array by using compareByTimeStamp-function
 *
 * @param array $array
 * @return array
 */
function sortPosts(array $array) : array
{
    usort($array, 'compareByTimeStamp');
        return $array;
};

    
?>