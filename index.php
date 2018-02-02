<?php
require 'vendor/autoload.php';

$auth = new TestGlobo\Services\Auth();
$auth->createUser('admin', 'admin');
$auth->start();

header('Content-Type: application/json');

$http = new TestGlobo\Services\Http();

$response = $http->get('http://revistaautoesporte.globo.com/rss/ultimas/feed.xml');
$xml = new TestGlobo\Services\ParseXML($response);

$items = $xml->getNodesByName('channel/item');
$response = [];

foreach ($items as $key => $item)
{
    $itemObject = new \TestGlobo\Models\Item();
    $itemObject->setTitle((string) $item->title);
    $itemObject->setLink((string) $item->link);

    $dom = new DOMDocument();
    $dom->loadHTML((string) $item->description );

    $description = new \TestGlobo\Models\Description($dom);
    $itemObject->setDescription($description->getData());

    $response[] = $itemObject;
}

echo json_encode(['feed' => $response]);