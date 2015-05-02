<?php
function shuffle_assoc($array) 
{
    $keys = array_keys($array);
    shuffle($keys);
    $shuffled = array();
    foreach ($keys as $key) 
    {
        $shuffled[$key] = $array[$key];
    }
     return $shuffled;
}

function memberSort( $a, $b ) {
    return $b['score'] - $a['score'];
}


/**
 * @param $time
 * @return array
 */
function calculateTimeTaken($time)
{
    $ret = array();
    $formattedTime = date("i:s", $time); //formatted as minutes:seconds
    $timeportions = explode(':', $formattedTime);

    $ret['mins'] = $timeportions[0] == '00' ? '' : ltrim($timeportions[0], '0') . ' mins ';
    $ret['secs'] = $timeportions[1] . ' secs';

    return $ret;
}