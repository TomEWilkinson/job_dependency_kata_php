<?php

include 'JobDependencyKata.php';

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Exception;

final class JobDependencyKataTests extends TestCase
{
    /** @test 
     * passes in an empty string to the function and expects an empty job list back
     */
    public function TestEmptyString(): void
    {
        $this->assertSame([], orderList([]));
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

    /** @test 
     * passing in a key value array containing 3 jobs with one that has a dependency
     * expects array containing the jobs passed oredered by depencies
     */
    public function TestMultipleJobsWithSingleDependency(): void
    {
        $jobs = array(
            "a" => "",
            "b" => "c",
            "c" => "",
        );

        $orderedList = orderList($jobs);
        $this->assertTrue(array_search('c', $orderedList) < array_search('b', $orderedList));
    }

    /** @test 
     * passing in a key value array containing multiple jobs with multiple dependencies
     * expects array containing the jobs passed ino redered by depencies
     */
    public function TestMultipleJobsWithMultipleDependencies(): void
    {
        $jobs = array(
            "a" => "",
            "b" => "c",
            "c" => "f",
            "d" => "a",
            "e" => "b",
            "f" => ""
        );

        $orderedList = orderList($jobs);
        $this->assertTrue(array_search('f', $orderedList) < array_search('c', $orderedList));
        $this->assertTrue(array_search('c', $orderedList) < array_search('b', $orderedList));
        $this->assertTrue(array_search('b', $orderedList) < array_search('e', $orderedList));
        $this->assertTrue(array_search('a', $orderedList) < array_search('d', $orderedList));
    }

    /** @test 
     * Jobs should not depend on themselves 
     * this is test to check an error is thrown when this is the case
     */
    public function TestSingleCircleDependency(): void
    {
        $jobs = array(
            "a" => "",
            "b" => "",
            "c" => "c",
        );

        $this->expectException("Exception");
        $this->expectExceptionCode(100);
        $this->expectExceptionMessage("Jobs cannot depend on themselves");

        $orderedList = orderList($jobs);
    }

    /** @test 
     * Jobs can't have circle Dependencies
     * this is test to check an error is thrown when this is the case
     */
    public function TestMultipleCircleDependency(): void
    {
        $jobs = array(
            "a" => "",
            "b" => "c",
            "c" => "f",
            "d" => "a",
            "e" => "",
            "f" => "b"
        );

        $this->expectException("Exception");
        $this->expectExceptionCode(101);
        $this->expectExceptionMessage("Jobs Cannot cause a cirlce depdency");

        $orderedList = orderList($jobs);
    }
}
