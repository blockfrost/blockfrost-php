<?php 

namespace Blockfrost;

use OpenAPI\Client\Api\CardanoAddressesApi;
use OpenAPI\Client\Model\AddressContent;
use OpenAPI\Client\Model\AddressContentExtended;
use OpenAPI\Client\Model\AddressContentTotal;





class AddressesService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoAddressesApi( $this->getClient(), /*config"*/);
    }
    
    public function getAddress($address):AddressContent
    {
        return $this->call( $this->api->addressesAddressGetAsyncWithHttpInfo($address) )[0];
    }
    
    public function getAddressExtended($address):AddressContentExtended
    {
        return $this->call( $this->api->addressesAddressExtendedGetAsyncWithHttpInfo($address) )[0];
    }
    
    public function getAddressTotal($address):AddressContentTotal
    {
        return $this->call( $this->api->addressesAddressTotalGetAsyncWithHttpInfo($address) )[0];
    }
    
    public function getAddressUTXOs($address):array
    {
        return $this->call( $this->api->addressesAddressUtxosGetAsyncWithHttpInfo($address) )[0]; //PAGE
    }
    
    public function getAddressUTXOsOfAsset($address, $asset):array
    {
        return $this->call( $this->api->addressesAddressUtxosAssetGetAsyncWithHttpInfo($address, $asset))[0]; //PAGE
    }
    
    public function getAddressTransactions($address):array //<string>? //DEPRECATED
    {
        return $this->call( $this->api->addressesAddressTxsGetAsyncWithHttpInfo($address))[0]; //PAGE
    }
    
    public function getAddressTransactionsFromTo($address, string $from =null, string $to = null):array //<AddressTransactionsContentInner>
    {
        return $this->call( $this->api->addressesAddressTransactionsGetAsyncWithHttpInfo($address, 100, 1, 'asc', $from, $to))[0]; //PAGE
    }
    
    
    
    
}







?>