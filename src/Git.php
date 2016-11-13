<?php

namespace CapsLockStudio\Deploy\Pusher;

class Git
{

    public static function create()
    {
        if ($repo = getenv("TRAVIS_REPO_SLUG")) {
            return new Git\CI\Travis($repo);
        } elseif ($repo = getenv("GIT_URL")) {
            return new Git\CI\Jenkins($repo);
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
