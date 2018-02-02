<?php

use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase {

    /**
     * @var \TestGlobo\Services\Http
     */
    protected $http;

    public function setUp()
    {
        $this->http = new \TestGlobo\Services\Http();
        parent::setUp();
    }

    public function testSimpleRequest()
    {
        $response = $this->http->get('http://revistaautoesporte.globo.com/rss/ultimas/feed.xml');
        $this->assertInstanceOf(SimpleXMLElement::class, $response);
    }

}