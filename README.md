# NsqToSwoole


PHP Swoole client for [NSQ](https://github.com/bitly/nsq).

### Requirements

  - PHP 5.6 or higher
  - Swoole 1.8.6 or higher

### Installation

    pecl install swoole

    composer require iris/nsq_to_swoole


### Testing it out

    cd nsqToSwoole

Publish:

    php tests/TestPub.php

Subscribe:

    php tests/TestSub.php

### Publishing

The client supports publishing to N `nsqd` servers. which must be specified 
explicitly by hostname. And supports publishing multiple messages.

```php
$client = new Iris\NsqToSwoole\Client;

$client->publishTo([
    ['host' => 'localhost', 'port' => 4150]
])->publish('test', 'single message');

//multiple messages
$client->publish('test', ['message one', 'message two']);

//HA publishing:
$client->publishTo([
    ['host' => '139.196.205.19', 'port' => 4150],
], Iris\NsqToSwoole\Client::PUB_QUORUM)->publish('test', 'HA publishing message');
```

### Subscribing

The client supports subscribing from N `nsqd` servers, each of which will be
auto-discovered from one or more `nslookupd` servers. The way this works is
that `nslookupd` is able to provide a list of auto-discovered nodes hosting
messages for a given topic.

```php
$lookup = new Iris\NsqToSwoole\Lookup\Lookupd([
    ['host' => '139.196.205.19', 'port' => 4161],
]);

$client = new Iris\NsqToSwoole\Client;

$client->subscribe($lookup, 'test', 'web', function($moniter, $msg) {
    echo sprintf("READ\t%s\t%s\n", $msg->getId(), $msg->getPayload());
});
```

