<?php 

namespace Blockfrost\Address;



use Blockfrost\Service;
use Blockfrost\Page;

class AddressesService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**Obtain information about a specific address.
     * @param string $address
     * @return Address
     */
    public function getAddress(string $address):Address
    {
        $resp = $this->get("/addresses/{$address}");
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
                'script' => 'boolean',
                'type' => 'string',
                '_type' => '\Blockfrost\Address\Address',
                'stake_address' => 'string',
                'address' => 'string',
                'amount' => ['array', '\Blockfrost\Address\AddressAccountSum']
                
            ] );
    }
    
    /**Obtain extended information about a specific address.
     * @param string $address
     * @return AddressExtended
     */
    public function getAddressExtended(string $address):AddressExtended
    {
        $resp = $this->get("/addresses/{$address}/extended");
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
                'script' => 'boolean',
                'type' => 'string',
                '_type' => '\Blockfrost\Address\AddressExtended',
                'stake_address' => 'string',
                'address' => 'string',
                'amount' => ['array', '\Blockfrost\Address\AddressSum']
                
            ] );
    }
    
    /**Obtain extended information about a specific address
     * @param string $address
     * @return AddressTotal
     */
    public function getAddressTotal(string $address):AddressTotal
    {
        $resp = $this->get("/addresses/{$address}/total");
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
                'address' => 'string',
                'tx_count' => 'int',
                '_type' => '\Blockfrost\Address\AddressTotal',
                
                'received_sum' => ['array', '\Blockfrost\Address\AddressSum'],
                'sent_sum' => ['array', '\Blockfrost\Address\AddressSum']
                
            ] );
    }
    
    /**UTXOs of the address.
     * @param string $address
     * @param Page $page
     * @return array
     */
    public function getAddressUTXOs(string $address, Page $page = null):array
    {
        $resp = $this->get("/addresses/{$address}/utxos", $page);
        
        $t = ['_kind' => 'object',
              '_type' => '\Blockfrost\Address\AddressTotal',
               'tx_hash' => 'string',
              'output_index' => 'int',
              'block' => 'string',
            'data_hash' => 'string',
            'amount' => ['array', '\Blockfrost\Address\AddressSum'],
        ];
        
        return $this->resp_from_json($resp, ['array', $t]);
    }
    
    /**Address UTXOs of a given asset
     * @param string $address
     * @param string $asset
     * @param Page $page
     * @return array
     */
    public function getAddressUTXOsOfAsset(string $address, string $asset, Page $page = null):array
    {
        $resp = $this->get("/addresses/{$address}/utxos/{$asset}", $page);
        
        $t = ['_kind' => 'object',
            '_type' => '\Blockfrost\Address\AddressTotal',
            'tx_hash' => 'string',
            'output_index' => 'int',
            'block' => 'string',
            'data_hash' => 'string',
            'amount' => ['array', '\Blockfrost\Address\AddressSum'],
        ];
        
        return $this->resp_from_json($resp, ['array', $t]);
    }
    
    /**Transactions on the address.
     * @param string $address
     * @param Page $page
     * @param int $from
     * @param int $to
     * @return array
     */
    public function getAddressTransactions(string $address, Page $page = null, int $from = null, int $to = null):array //two more ints
    {
        $params = $from != null || $to != null? [] : null;
        
        if( $from )
            $params["from"] = $from;
        
        if( $to ) 
            $params["to"] = $to;
        
        $resp = $this->get("/addresses/{$address}/transactions", $page, $params);
        
      
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Address\AddressTransaction']);
    }
    
 
    
}







?>