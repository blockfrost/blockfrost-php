<?php 

namespace Blockfrost\Metadata;

use Blockfrost\Service;

class MetadataService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getTransactionMetadataLabels():array 
    {
        $resp = $this->get("/metadata/txs/labels");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataLabel']);

    }
    
    public function getTransactionMetadataAsJSON(string $label):array //<TxMetadataLabelJsonInner>
    {
        $resp = $this->get("/metadata/txs/labels/{$label}");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataJSON']);
    }
    
    public function getTransactionMetadataAsCBOR(string $label):array //<TxMetadataLabelCborInner>
    {
        $resp = $this->get("/metadata/txs/labels/{$label}/cbor");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Metadata\MetadataCBOR']);
    }
}




?>