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

function compareByTimeStamp($time1, $time2) 
{ 
    if ($time1 < $time2) 
        return 1; 
    else if ($time1 > $time2)  
        return -1; 
    else
        return 0; 
} 

function sortPosts(array $array) : array
{
    usort($array, 'compareByTimeStamp');
        return $array;
};
    
?>