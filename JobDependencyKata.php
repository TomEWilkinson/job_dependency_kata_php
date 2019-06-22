<?php


/**
 * function to return an ordered list
 *
 * @param string $job
 * @return void
 */
function orderList($jobs) {

    if(!$jobs)
    {
        return "";
    }

    $orderedList = [];
    foreach ($jobs as $job => $dependency) {
       array_push($orderedList, $job);
    }

    return $orderedList;
}