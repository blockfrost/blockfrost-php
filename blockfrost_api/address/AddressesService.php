<?php 

namespace Blockfrost\Address;



use Blockfrost\Service;

class AddressesService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getAddress($address):Address
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
    
    public function getAddressExtended($address):AddressExtended
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
    
    public function getAddressTotal($address):AddressTotal
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
    
    public function getAddressUTXOs($address):array
    {
        $resp = $this->get("/addresses/{$address}/utxos");
        
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
    
    public function getAddressUTXOsOfAsset($address, $asset):array
    {
        $resp = $this->get("/addresses/{$address}/utxos/{$asset}");
        
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
    
    public function getAddressTransactions($address):array
    {
        $resp = $this->get("/addresses/{$address}/transactions");
        
      
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Address\AddressTransaction']);
    }
    
 
    
}







?>