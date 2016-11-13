<?php

namespace CapsLockStudio\Deploy\Pusher\Context;

class Header
{

    const OK       = 2;
    const REDIRECT = 3;
    const ERROR    = 4;
    const FATAL    = 5;
    const TIMEOUT  = 6;

    private $code;

    public function __construct($header)
    {
        preg_match("/^HTTP\/\d.\d (\d)\d+ [A-Za-z0-9]+$/", $header, $match);
        $this->code = $match ? array_pop($match) : self::TIMEOUT;
    }

    public function isError()
    {
        return $this->code == self::ERROR;
    }

    public function isFatal()
    {
        return $this->code == self::FATAL;
    }

    public function isTimeout()
    {
        return $this->code == self::TIMEOUT;
    }

    public function isOK()
    {
        return $this->code == self::OK;
    }

    public function isRedirect()
    {
        return $this->code == self::REDIRECT;
    }
}
