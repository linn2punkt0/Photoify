<?php

declare(strict_types=1);


// function sortByDate(array $a, array $b): int {
//     return $a['date'] - $b['date'];
// };


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