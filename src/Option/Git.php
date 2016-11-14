<?php

namespace CapsLockStudio\Deploy\Pusher\Option;

use CapsLockStudio\Deploy\Pusher\Option\Git\CI\Travis;
use CapsLockStudio\Deploy\Pusher\Option\Git\CI\Jenkins;

class Git
{
    private $owner;
    private $repo;

    public function __construct($owner, $repo)
    {
        $this->owner = $owner;
        $this->repo  = $repo;
    }

    public static function extract()
    {
        $repo = getenv("TRAVIS_REPO_SLUG");
        $repo = $repo ?: getenv("GIT_URL");
        $repo = $repo ?: getenv("CIRCLE_REPOSITORY_URL");
        $repo = $repo ?: "/";

        if (preg_match("/(\w+:\/\/)(.+@)*([\w\d\.]+)(:[\d]+){0,1}\/*(.*)/", $repo, $match)) {
            $repo = array_pop($match);
            $repo = preg_replace("/\.git$/", "", $repo);
        }

        list($owner, $repo) = explode("/", $repo);

        $owner = $owner ?: getenv("OWNER");
        $repo  = $repo ?: getenv("REPO");

        return new self($owner, $repo);
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getRepo()
    {
        return $this->repo;
    }
}
