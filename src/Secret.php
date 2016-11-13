<?php

namespace CapsLockStudio\Deploy\Pusher;

class Secret
{

    private $secret;

    public function __construct($secret)
    {
        $this->secret = $secret ?: getenv("SECRET");
    }

    public function hash($json)
    {
        $json = json_decode(json_encode($json));
        $json = json_encode($json, JSON_UNESCAPED_SLASHES);


        return hash_hmac("sha1", $json, $this->secret);
    }
}
