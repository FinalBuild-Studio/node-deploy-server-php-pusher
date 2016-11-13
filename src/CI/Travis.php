<?php

namespace CapsLockStudio\Deploy\Pusher\Git;

class Travis
{
    private $owner;
    private $repo;

    public function __construct($repo)
    {
        list($this->owner, $this->repo) = explode("/", $repo);
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
