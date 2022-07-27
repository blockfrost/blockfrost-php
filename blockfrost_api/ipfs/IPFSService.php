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

    /**You need to /ipfs/pin/add an object to avoid it being garbage collected. This usage is being counted in your user account quota.
     * @param string $name
     * @param StreamInterface $stream
     * @return IPFSAdd
     */
    public function addFile(string $name, StreamInterface $stream):IPFSAdd
    {
        $resp = $this->post_file("/ipfs/add", $name, $stream);
     
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSAdd');
    }
    
    /**Retrieve an object from the IPFS gateway (useful if you do not want to rely on a public gateway, such as ipfs.blockfrost.dev).
     * @param string $ipfs_path
     * @return StreamInterface
     */
    public function getFile(string $ipfs_path):StreamInterface
    {       
        $resp = $this->get("/ipfs/gateway/{$ipfs_path}");
        
        return $this->resp_stream($resp);
    }
    
    /**Pinned objects are counted in your user storage quota.
     * @param string $IPFS_path
     * @return IPFSPinChange
     */
    public function pinObject(string $IPFS_path):IPFSPinChange
    {
        $resp = $this->post_void("/ipfs/pin/add/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinChange');
    }
    
    /**List objects pinned to local storage
     * @param Page $page
     * @return array
     */
    public function listPinnedObjects(Page $page = null):array //<IPFSPinnedObject> //can return null apparently
    {
        $resp = $this->get("/ipfs/pin/list", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\IPFS\IPFSPinnedObject']);
    }
   
    /**Get information about locally pinned IPFS object
     * @param string $IPFS_path
     * @return IPFSPinnedObject
     */
    public function getPinnedObject(string $IPFS_path):IPFSPinnedObject
    {
        $resp = $this->get("/ipfs/pin/list/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinnedObject');
    }
    
    /**Remove pinned objects from local storage
     * @param string $IPFS_path
     * @return IPFSPinChange
     */
    public function removePinnedObject(string $IPFS_path):IPFSPinChange
    {
        $resp = $this->post_void("/ipfs/pin/remove/{$IPFS_path}");
        
        return $this->resp_from_json($resp, '\Blockfrost\IPFS\IPFSPinChange');
    }
}

