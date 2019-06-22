<?php


/**
 * function to return an ordered list
 *
 * @param string $job
 * @return void
 */
function orderList($jobs)
{

    if (!$jobs) {
        return "";
    }

    $orderedList = [];
    $dependencyList = [];
    foreach ($jobs as $job => $dependency) {

        if ($dependency) {
            $dependencyList[$dependency] = $job;
        }

        if (isset($dependencyList[$job])) {
            array_splice($orderedList, array_search($dependencyList[$job], $orderedList), 0, $job);
            continue;
        }
        array_push($orderedList, $job);
    }

    return $orderedList;
}
