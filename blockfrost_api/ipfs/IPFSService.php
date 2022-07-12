<?php 

namespace Blockfrost\IPFS;

use Blockfrost\Service;
use Psr\Http\Message\StreamInterface;
use Blockfrost\Page;

class IPFSService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);  
    }

    public function addFile($name, StreamInterface $stream):IPFSAdd
    {
        $resp = $this->post_file("/ipfs/add", $name, $stream);
     
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSAdd');
    }
    
    public function getFile($ipfs_path):StreamInterface
    {       
        $resp = $this->get("/ipfs/gateway/{$ipfs_path}");
        
        return $this->resp_stream($resp);
    }
    
    public function pinObject(string $IPFS_path):IPFSPinChange
    {
        $resp = $this->post_void("/ipfs/pin/add/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinChange');
    }
    
    public function listPinnedObjects(Page $page = null):array //<IPFSPinnedObject> //can return null apparently
    {
        $resp = $this->get("/ipfs/pin/list", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\IPFS\IPFSPinnedObject']);
    }
   
    public function getPinnedObject($IPFS_path):IPFSPinnedObject
    {
        $resp = $this->get("/ipfs/pin/list/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinnedObject');
    }
    
    public function removePinnedObject($IPFS_path):IPFSPinChange
    {
        $resp = $this->post_void("/ipfs/pin/remove/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinChange');
    }
}

