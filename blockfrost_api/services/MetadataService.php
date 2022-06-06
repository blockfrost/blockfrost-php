<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoMetadataApi;






class MetadataService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoMetadataApi( $this->getClient(), /*config"*/);
    }
    
    public function getTransactionMetadataLabels():array // <TxMetadataLabelsInner>
    {
        return $this->call( $this->api->metadataTxsLabelsGetAsyncWithHttpInfo() )[0]; //PAGE 
    }
    
    public function getTransactionMetadataAsJSON(string $label):array //<TxMetadataLabelJsonInner>
    {
        return $this->call( $this->api->metadataTxsLabelsLabelGetAsyncWithHttpInfo($label) )[0]; //PAGE
    }
    
    public function getTransactionMetadataAsCBOR(string $label):array //<TxMetadataLabelCborInner>
    {
        return $this->call( $this->api->metadataTxsLabelsLabelCborGetAsyncWithHttpInfo($label) )[0]; //PAGE
    }
}




?>