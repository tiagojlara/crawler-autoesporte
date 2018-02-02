<?php

use PHPUnit\Framework\TestCase;

class XMLParseTest extends TestCase {

    /**
     * @var \TestGlobo\Services\ParseXML
     */
    protected $xml;

    public function setUp()
    {
        $mockXml = '<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">
        <channel>
        <title>...</title>
        <link>http://revistaautoesporte.globo.com/</link>
        <description/>
        <language>pt-BR</language>
        <copyright>© Todos os direitos reservados.</copyright>
        <image>...</image>
        <item>...</item>
        <item>...</item>
        </channel>
        </rss>';

        $this->xml = new \TestGlobo\Services\ParseXML( new SimpleXMLElement($mockXml) );
    }

    public function testGetElementByName()
    {
        $response = $this->xml->getNodesByName('channel');
        $this->assertEquals(1, count($response));
        $this->assertInstanceOf(SimpleXMLElement::class, $response[0]);
    }

    public function testGetElementBySubPath()
    {
        $response = $this->xml->getNodesByName('channel/item');
        $this->assertEquals(2, count($response));
        $this->assertInstanceOf(SimpleXMLElement::class, $response[0]);
    }

    public function testCreateDescription()
    {
        $mock = new DOMDocument();
        $mock->loadHTML('
            <p>My text</p>
            <div><img src="https://lorempixel.com/640/480" alt=""></div>
            <div><ul><li><a href="http://globo.com"></a></li></ul></div>
        ');

        $description = new \TestGlobo\Models\Description($mock);
        $description = $description->getData();

        $this->assertEquals([
            [
                'type' => 'text',
                'content' => 'My text'
            ],
            [
                'type' => 'image',
                'content' => 'https://lorempixel.com/640/480'
            ],
            [
                'type' => 'links',
                'content' => [
                    'http://globo.com'
                ]
            ]
        ], $description);



    }

}