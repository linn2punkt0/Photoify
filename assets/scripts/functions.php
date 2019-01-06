<?php

declare(strict_types=1);

/**
 * Sort posts by date
 *
 * @param array $a
 * @param array $b
 * @return integer
 */
function sortByDate(array $a, array $b): int {
    return $a['date'] - $b['date'];

};

function compareByTimeStamp($time1, $time2) 
{ 
    if (strtotime($time1) < strtotime($time2)) 
        return 1; 
    else if (strtotime($time1) > strtotime($time2))  
        return -1; 
    else
        return 0; 
} 

usort($allPosts, "compareByTimeStamp");