<?php

namespace TestGlobo\Models;

class Description {

    /**
     * @var array
     */
    private $data = [];

    /**
     * Description constructor.
     *
     * @param \DOMElement|null $description
     */
    public function __construct(\DOMDocument $dom)
    {
        return $this->init($dom);
    }

    /**
     * @param \DOMElement|null $dom
     *
     * @return array
     */
    public function init(\DOMNode $dom)
    {
        foreach ($dom->childNodes as $node)
        {
            if($node->nodeName === 'img') {
                $this->createImageNode($node);
            } elseif($node->nodeName === 'p') {
                $this->createTextNode($node);
            } elseif($node->nodeName === 'ul') {
                $this->createLinksNode($node);
            }
            if($node->childNodes) {
                $this->init($node);
            }
        }

        return $this->data;
    }

    /**
     * @param \DOMElement $element
     */
    protected function createImageNode(\DOMElement $element)
    {
        $this->data[] = [
            'type' => 'image',
            'content' => $element->getAttribute('src')
        ];
    }

    /**
     * @param \DOMElement $element
     */
    protected function createTextNode(\DOMElement $element)
    {
        $text = trim($element->nodeValue);
        if($text == " ") return;

        $this->data[] = [
            'type' => 'text',
            'content' => $text
        ];
    }

    /**
     * @param \DOMElement $element
     */
    protected function createLinksNode(\DOMElement $element)
    {
        $links = [
            'type' => 'links',
            'content' => []
        ];

        foreach ($element->getElementsByTagName('a') as $link) {
            $links['content'][] = $link->getAttribute('href');
        }

        $this->data[] = $links;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

}