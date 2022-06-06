<?php 

use Blockfrost\BlockService;

require __DIR__.'/vendor/autoload.php';

$projectId = "MY_PROJECT_ID";

$blockService = new BlockService($projectId);

try
{
    $res = $blockService->getLatestBlock();

    echo $res->getHash();
}

catch(Exception $err)
{
    echo $err->getMessage();
}


?>