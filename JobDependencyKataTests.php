<?php

include 'JobDependencyKata.php';

use PHPUnit\Framework\TestCase;

final class JobDependencyKataTests extends TestCase
{
    /** @test 
     * passes in an empty string to the function and expects an empty job list back
     */
    public function TestEmptyString(): void
    {
        $this->assertSame("", orderList(""));
    }

    /** @test 
     * passing in a key value array containing the job and an empty dependency value
     * expects array containing the job passed in
     */
    public function TestSingleJob(): void
    {
        $jobs = array(
            "a" => "",
        );

        $this->assertSame(["a"], orderList($jobs));
    }

    /** @test 
     * passing in a key value array containing 3 jobs and an empty dependency values
     * expects array containing the jobs passed in
     */
    public function TestMultipleJobs(): void
    {
        $jobs = array(
            "a" => "",
            "b" => "",
            "c" => "",
        );

        $orderedList = orderList($jobs);
        $this->assertContains("a", $orderedList);
        $this->assertContains("b", $orderedList);
        $this->assertContains("c", $orderedList);
    }
}
