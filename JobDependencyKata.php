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

        if ($dependency == $job) {
            throw new Exception('Jobs cannot depend on themselves', 100);
        }

        if ($dependency) {
            $dependencyList[$dependency] = $job;
        }

        if (isset($dependencyList[$job])) {
            array_splice($orderedList, array_search($dependencyList[$job], $orderedList), 0, $job);
            circleDependencyCheck($dependencyList, $dependencyList[$job], $dependency);
            continue;
        }
        array_push($orderedList, $job);
    }

    return $orderedList;
}

/**
 * a recucsive function to check for a circle dependency
 *
 * @param array $dependencyList
 * @param string $nextDependency
 * @param string $originalDependency
 * @return bool
 */
function circleDependencyCheck($dependencyList, $nextDependency, $originalDependency)
{

    //if the orginal depency equals the next dependency we have a circle
    if (isset($dependencyList[$nextDependency]) && $originalDependency ==  $dependencyList[$nextDependency]) {
        throw new Exception('Jobs Cannot cause a cirlce depdency', 101);
    }

    //if it's not undefined the chain of dependencies continues
    if (isset($dependencyList[$nextDependency])) {
        circleDependencyCheck($dependencyList, $dependencyList[$nextDependency], $originalDependency);
    } else {
        return false;
    }
}
