<?php

namespace CapsLockStudio\Deploy\Pusher\Option;

use CapsLockStudio\Deploy\Pusher\Option\Git\CI\Travis;
use CapsLockStudio\Deploy\Pusher\Option\Git\CI\Jenkins;

class Git
{

    public static function create()
    {
        if ($repo = getenv("TRAVIS_REPO_SLUG")) {
            return new Travis($repo);
        } elseif ($repo = getenv("GIT_URL")) {
            return new Jenkins($repo);
        }

        return new self;
    }

    public function getOwner()
    {
        return "";
    }

    public function getRepo()
    {
        return "";
    }
}
