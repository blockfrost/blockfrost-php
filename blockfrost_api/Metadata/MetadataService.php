<?php 

namespace Blockfrost\Metadata;

use Blockfrost\Service;
use Blockfrost\Page;

class MetadataService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**List of all used transaction metadata labels.
     * @param Page $page
     * @return array
     */
    public function getTransactionMetadataLabels(Page $page = null):array 
    {
        $resp = $this->get("/metadata/txs/labels", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataLabel']);

    }
    
    /**Transaction metadata per label.
     * @param string $label
     * @param Page $page
     * @return array
     */
    public function getTransactionMetadataAsJSON(string $label, Page $page = null):array //<TxMetadataLabelJsonInner>
    {
        $resp = $this->get("/metadata/txs/labels/{$label}", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataJSON']);
    }
    
    /**Transaction metadata per label.
     * @param string $label
     * @param Page $page
     * @return array
     */
    public function getTransactionMetadataAsCBOR(string $label, Page $page = null):array //<TxMetadataLabelCborInner>
    {
        $resp = $this->get("/metadata/txs/labels/{$label}/cbor", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataCBOR']);
    }
}




?>