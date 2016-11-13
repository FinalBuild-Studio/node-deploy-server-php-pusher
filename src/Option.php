<?php

namespace CapsLockStudio\Deploy\Pusher;

class Option
{

    public function get()
    {
        $default = [
            "config"   => "",
            "tag"      => "",
            "command"  => "",
            "rollback" => true,
        ];

        $opt = getopt(null, $this->keys($default));
        $opt = array_merge($default, $opt);

        $opt["rollback"] = !$opt["rollback"];
        $opt["tag"]      = $opt["rollback"] ? false : $opt["tag"];

        $opt  = file_exists($opt["config"]) ? file_get_contents($opt["config"]) : json_encode($opt);
        $json = json_decode($opt, true) ?: [];

        $travis = getenv("TRAVIS_REPO_SLUG") ?: "/";

        list($owner, $repo) = explode("/", $travis);

        $dist  = getenv("DIST");
        $owner = getenv("OWNER") ?: $owner;
        $repo  = getenv("REPO") ?: $repo;

        $json["dist"]  = $dist;
        $json["owner"] = $owner;
        $json["repo"]  = $repo;

        return $json;
    }

    public function keys(array $array)
    {
        $data = [];
        foreach ($array as $key => $value) {
            $data[] = $key . (is_bool($value) ? "" : ":");
        }

        return $data;
    }
}
