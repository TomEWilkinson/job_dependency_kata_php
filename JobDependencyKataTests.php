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
}
