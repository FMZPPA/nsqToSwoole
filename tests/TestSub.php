<?php
/**
 * Subscribe test
 *
 * @author Janson
 * @create 2017-06-01
 */
require __DIR__ . '/../autoload.php';

$lookup = new Iris\NsqToSwoole\Lookup\Lookupd([
    ['host' => '139.196.205.19', 'port' => 4161],
]);

$client = new Iris\NsqToSwoole\Client;

$client->subscribe($lookup, 'test', 'web', function($moniter, $msg) {
    echo sprintf("READ\t%s\t%s\n", $msg->getId(), $msg->getPayload());
});
