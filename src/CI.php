<?php

namespace CapsLockStudio\Deploy\Pusher;

class CI
{

    public static function create()
    {
        if ($repo = getenv("TRAVIS_REPO_SLUG")) {
            return new CI\Travis($repo);
        } elseif ($repo = getenv("GIT_URL")) {
            return new CI\Git($repo);
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
