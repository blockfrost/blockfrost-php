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