<?php
require 'vendor/autoload.php';

header('Content-Type: application/json');

$http = new TestGlobo\Services\Http();

$response = $http->get('http://revistaautoesporte.globo.com/rss/ultimas/feed.xml');
$xml = new TestGlobo\Services\ParseXML($response);

$items = $xml->getNodesByName('channel/item');
$response = [];

foreach ($items as $key => $item)
{
    $itemObject = new \TestGlobo\Models\Item();
    $itemObject->setTitle((string) $item->link);
    $itemObject->setLink((string) $item->link);

    $dom = new DOMDocument();
    $dom->loadHTML((string) $item->description );

    $description = new \TestGlobo\Models\Description($dom);
    $itemObject->setDescription($description->getData());

    $response[] = $itemObject;
}

echo json_encode($response);