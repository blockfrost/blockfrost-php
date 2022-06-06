<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoBlocksApi;


use OpenAPI\Client\Model\BlockContent;
use OpenAPI\Client\Api\CardanoAccountsApi;

 




class BlockService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoBlocksApi( $this->getClient(), /*config"*/);
    }
    
    public function getLatestBlock():BlockContent
    {
        return $this->call( $this->api->blocksLatestGetAsyncWithHttpInfo() )[0];
    }
    
    public function getLatestBlockTransactions():array
    {
        return $this->call( $this->api->blocksLatestTxsGetAsyncWithHttpInfo() )[0]; //page
    }
    
    public function getBlock($hash_or_number):BlockContent 
    {
        return $this->call( $this->api->blocksHashOrNumberGetAsyncWithHttpInfo($hash_or_number))[0];
    }
    
    public function listNextBlocks($hash_or_number):array  //<BlockContent>             
    {
        return $this->call( $this->api->blocksHashOrNumberNextGetAsyncWithHttpInfo($hash_or_number))[0]; //page
    }
    
    public function listPreviousBlocks($hash_or_number):array //<BlockContent>
    {
        return $this->call( $this->api->blocksHashOrNumberPreviousGetAsyncWithHttpInfo($hash_or_number))[0]; //page
    }
    
    public function getSpecificBlockInSlot($slot):BlockContent 
    {
        return $this->call( $this->api->blocksSlotSlotNumberGetAsyncWithHttpInfo($slot))[0];
    }
    
    public function getSpecificBlockInSlotInEpoch($slot, $epoch):BlockContent 
    {
        return $this->call( $this->api->blocksEpochEpochNumberSlotSlotNumberGetAsyncWithHttpInfo($epoch, $slot) )[0]; 
    }
    
    public function getBlockTransactions($hash_or_number):array 
    {
        return $this->call( $this->api->blocksHashOrNumberTxsGetAsyncWithHttpInfo($hash_or_number) )[0]; //page
    }
    
    public function getAddressesAffectedInBlock($hash_or_number):array
    {
        return $this->call( $this->api->blocksHashOrNumberAddressesGetAsyncWithHttpInfo($hash_or_number) )[0]; //page
    }
}

//$request = $this->api->blocksLatestGetRequest()->withAddedHeader("project_id", $this->projectId);

?>