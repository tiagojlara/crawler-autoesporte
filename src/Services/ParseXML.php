<?php

namespace TestGlobo\Services;

/**
 * Class ParseXML
 * @package TestGlobo\Services
 */
class ParseXML {

    /**
     * @var \SimpleXMLElement
     */
    private $XMLElement;


    /**
     * ParseXML constructor.
     *
     * @param \SimpleXMLElement $XMLElement
     */
    public function __construct( \SimpleXMLElement $XMLElement)
    {
        $this->XMLElement = $XMLElement;
    }

    /**
     * @param string            $name
     *
     * @return array
     */
    public function getNodesByName( string $name ) : array
    {
        return $this->XMLElement->xpath($name);
    }

}