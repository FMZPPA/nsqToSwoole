<?php
/**
 * Publish test
 *
 * @author Iris Xie
 * @create 2017-06-01
 */
require __DIR__ . '/../autoload.php';

$hosts = [
    ['host' => '139.196.205.19', 'port' => 4150],
//    ['host' => '192.168.1.51', 'port' => 4150]
];

$cl = 1;
$try = 1;

$client = new Iris\NsqToSwoole\Client;
$client->publishTo($hosts, $cl);

$client->publish('test', 'From nsq swoole client', $try);
