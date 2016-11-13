<?php

namespace CapsLockStudio\Deploy\Pusher\Git\CI;

class Jenkins
{
    private $owner;
    private $repo;

    public function __construct($repo)
    {
        preg_match("/(\w+:\/\/)(.+@)*([\w\d\.]+)(:[\d]+){0,1}\/*(.*)/", $repo, $match);
        $repo = array_pop($match);
        $repo = preg_replace("/\.git$/", "", $repo);
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
