<?php

namespace CapsLockStudio\Deploy\Pusher;

use CapsLockStudio\Deploy\Pusher\Context\Secret;
use CapsLockStudio\Deploy\Pusher\Context\Header;

class Context
{

    private $secret;
    private $opts;
    private $header;

    public function __construct($secret = "")
    {
        $this->secret = $secret;
    }

    public function set(array $json)
    {
        $secret = new Secret($this->secret);
        $hash   = $secret->hash($json);

        $this->opts = [
            "http" =>  [
                "method"        => "POST",
                "header"        => [
                    "Content-type: application/json",
                ],
                "ignore_errors" => true
            ]
        ];

        $this->opts["http"]["header"][] = "x-hub-signature: sha1={$hash}";
        $this->opts["http"]["content"]  = json_encode($json);

        return $this;
    }

    public function execute($host)
    {
        $context      = stream_context_create($this->opts);
        $response     = @file_get_contents($host, false, $context);
        $this->header = !empty($http_response_header) ? $http_response_header[0] : "";

        return $this;
    }

    public function getHeder()
    {
        return new Header($this->header);
    }
}
