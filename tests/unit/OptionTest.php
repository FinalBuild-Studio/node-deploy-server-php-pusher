<?php

use CapsLockStudio\Deploy\Pusher\Option;

class OptionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
        putenv("TRAVIS_REPO_SLUG");
        putenv("GIT_URL");
        putenv("CIRCLE_REPOSITORY_URL");
        putenv("REPO");
        putenv("OWNER");
    }

    public function testTravisCI()
    {
        putenv("TRAVIS_REPO_SLUG=foo/bar");
        $options = (new Option())->get();

        $this->assertEquals("foo", $options["owner"]);
        $this->assertEquals("bar", $options["repo"]);
    }

    public function testCircleCI()
    {
        putenv("CIRCLE_REPOSITORY_URL=https://github.com/foo/bar.git");
        $options = (new Option())->get();
        $this->assertEquals("foo", $options["owner"]);
        $this->assertEquals("bar", $options["repo"]);
    }

    public function testJenkinsCI()
    {
        putenv("GIT_URL=https://github.com/foo/bar.git");
        $options = (new Option())->get();
        $this->assertEquals("foo", $options["owner"]);
        $this->assertEquals("bar", $options["repo"]);
    }

    public function testOtherCI()
    {
        putenv("OWNER=foo");
        putenv("REPO=bar");
        $options = (new Option())->get();
        $this->assertEquals("foo", $options["owner"]);
        $this->assertEquals("bar", $options["repo"]);
    }
}
