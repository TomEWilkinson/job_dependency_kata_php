<?php

include 'JobDependencyKata.php';

use PHPUnit\Framework\TestCase;

final class JobDependencyKataTests extends TestCase
{
    /** @test */
    public function TestEmptyString(): void
    {
        $this->assertSame("", orderList(""));
    }

    /** @test */
    public function TestSingleJob(): void
    {
        $jobs = array(
            "a" => "",
        );

        $this->assertSame(["a"], orderList($jobs));
    }
}
