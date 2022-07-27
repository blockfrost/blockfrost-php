<img src="https://blockfrost.io/images/logo.svg" width="250" align="right" height="90">

# blockfrost-php

<br/>

<p align="center">PHP SDK for Blockfrost.io API.</p>
<p align="center">
  <a href="#getting-started">Getting started</a> •
  <a href="#installation">Installation</a> •
  <a href="#usage">Usage</a>
</p>
<br>

## Getting started

To use this SDK, you first need login into to [blockfrost.io](https://blockfrost.io) create your project to retrive your API token.

<img src="https://i.imgur.com/smY12ro.png">

<br/>

## Installation

###  Composer

This SDK uses guzzlehttp for REST.  [Composer](https://getcomposer.org/) is the preferred package manager to import this:

###  composer.json

```json
{
	"require" : {
		"guzzlehttp/guzzle" : "^7.0"
	},
	"autoload" : {
		"psr-4" : {
			"Blockfrost\\" 		  : "../blockfrost_api/"
		}
	},
	"minimum-stability" : "dev",
	"require-dev": {
		"phpunit/phpunit": "^9.5"
	}
}
```

```console
$ php composer.phar update
```

## Usage

Using the SDK is pretty straight-forward as you can see from the following example.

### Cardano

```php
<?php 

use Blockfrost\Block\BlockService;
use Blockfrost\Service;

require __DIR__.'/vendor/autoload.php';

$projectId = "MY_PROJECT_ID";

$blockService = new BlockService(Service::$NETWORK_CARDANO_MAINNET, $projectId);

try
{
    $res = $blockService->getLatestBlock();

    echo $res->hash;
}

catch(Exception $err)
{
    echo $err->getMessage();
}


?>
```

