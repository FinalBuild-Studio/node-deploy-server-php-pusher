<?php

namespace CapsLockStudio\Deploy\Pusher;

class Git
{

    public static function create()
    {
        if ($repo = getenv("TRAVIS_REPO_SLUG")) {
            return new Git\Travis($repo);
        } elseif ($repo = getenv("GIT_URL")) {
            return new Git\Jenkins($repo);
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
