<?php

namespace CapsLockStudio\Deploy\Pusher;

use CapsLockStudio\Deploy\Pusher\Option\Git;

class Option
{

    public function get()
    {
        $default = [
            "config"   => "",
            "tag"      => "",
            "command"  => "",
            "ignore"   => "",
            "rollback" => true,
        ];

        $opt = getopt(null, $this->keys($default));
        $opt = array_merge($default, $opt);

        $opt["config"]   = $opt["config"] ?: ".node-deply-server-setting.json";
        $opt["rollback"] = !$opt["rollback"];
        $opt["tag"]      = $opt["rollback"] ? false : $opt["tag"];

        $opt  = file_exists($opt["config"]) ? file_get_contents($opt["config"]) : json_encode($opt);
        $json = json_decode($opt, true) ?: [];

        $owner = Git::extract()->getOwner();
        $repo  = Git::extract()->getRepo();

        $dist = getenv("DIST") ?: "";

        $json["dist"]   = $dist;
        $json["owner"]  = $owner;
        $json["repo"]   = $repo;

        return $json;
    }

    private function keys(array $array)
    {
        $data = [];
        foreach ($array as $key => $value) {
            $data[] = $key . (is_bool($value) ? "" : ":");
        }

        return $data;
    }
}
