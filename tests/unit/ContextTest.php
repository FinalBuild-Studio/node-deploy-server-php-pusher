<?php

use CapsLockStudio\Deploy\Pusher\Context;

class ContextTest extends \Codeception\Test\Unit
{

    use InterNations\Component\HttpMock\PHPUnit\HttpMockTrait;

    /**
     * @var \UnitTester
     */
    protected $tester;

    public static function setUpBeforeClass()
    {
        static::setUpHttpMockBeforeClass('8080', 'localhost');
    }

    public static function tearDownAfterClass()
    {
        static::tearDownHttpMockAfterClass();
    }

    protected function _before()
    {
        $this->setUpHttpMock();
    }

    protected function _after()
    {
        $this->tearDownHttpMock();
    }

    public function testExecuteContext()
    {
        $json      = ["foo" => "bar"];
        $context   = (new Context("secret"))->set($json)->execute("http://localhost:8080");
        $content   = file_get_contents("http://localhost:8080/_request/latest");
        $content   = unserialize($content);
        $server    = $content["server"];
        $signature = $server["HTTP_X_HUB_SIGNATURE"];
        $sign      = hash_hmac("sha1", json_encode($json, JSON_UNESCAPED_SLASHES), "secret");
        $this->assertEquals("sha1={$sign}", $signature);

        $header = $context->getHeader();
        $this->assertTrue($header->isError());
        $this->assertFalse($header->isOK());
        $this->assertFalse($header->isTimeout());
        $this->assertFalse($header->isRedirect());
        $this->assertFalse($header->isFatal());
    }
}
