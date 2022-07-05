<?php 

use Blockfrost\Service;
use Blockfrost\IPFS\IPFSService;

require __DIR__.'/vendor/autoload.php';

$projectId = "MY_PROJECT_ID";

$ipfsService = new IPFSService(Service::$NETWORK_IPFS, $projectId);

try
{
    $ipfsFileAdd = $ipfsService->addFile("hello.txt", $ipfsService->streamFromString("HELLO!") );
    
    $ipfsService->pinObject($ipfsFileAdd->ipfs_hash);
    
    $stream = $ipfsService->getFile($ipfsFileAdd->ipfs_hash);
    
    echo "File Contents: ".$ipfsService->readStreamAsString($stream);
}

catch(Exception $err)
{
    echo $err->getMessage();
}


?>