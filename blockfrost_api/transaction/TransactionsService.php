<?php 

namespace Blockfrost\Transaction;

use Blockfrost\Service;
use Psr\Http\Message\StreamInterface;

class TransactionsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    public function getTransaction($hash):Transaction 
    {
        $resp = $this->get("/txs/{$hash}");
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
                '_type' => '\Blockfrost\Transaction\Transaction',
                'output_amount' => ['array', '\Blockfrost\Transaction\TransactionAmount']
            ] );
    }
    
    public function getTransactionUTXOs($hash):TransactionUTXOs
    {
        $resp = $this->get("/txs/{$hash}/utxos");
        
        $a = ['_kind' => 'object',
            '_type' => '\Blockfrost\Transaction\TransactionUTXOInput',
            'amount' => ['array', '\Blockfrost\Transaction\TransactionAmount']
        ];
        
        $b = ['_kind' => 'object',
            '_type' => '\Blockfrost\Transaction\TransactionUTXOOutput',
            'amount' => ['array', '\Blockfrost\Transaction\TransactionAmount']
        ];
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
             '_type' => '\Blockfrost\Transaction\TransactionUTXOs',
              'inputs'  => ['array', $a],
              'outputs' => ['array', $b]
            ] );
    }
    
    public function getTransactionStakeAddressCertificates($hash):array
    {
        $resp = $this->get("/txs/{$hash}/stakes");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionAddressCertificate'] );
    }
    
    public function getTransactionDelegationCertificates($hash):array
    {
        $resp = $this->get("/txs/{$hash}/delegations");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionDelegationCertificate'] );
    }
    
    public function getTransactionWithdrawals($hash):array
    {
        $resp = $this->get("/txs/{$hash}/withdrawals");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionWithdrawal'] );
    }
    
    public function getTransactionMIRs($hash):array
    {
        $resp = $this->get("/txs/{$hash}/mirs");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMir'] );
    }
    
    public function getTransactionStakePoolUpdateCertificates($hash):array
    {
        $resp = $this->get("/txs/{$hash}/pool_updates");
        
        $a =  ['_kind' => 'object',
            '_type' => '\Blockfrost\Transaction\TransactionRegistrationAndUpdateCertificate',
            'owners'  => ['array', 'string'],
            'metadata' => '\Blockfrost\Transaction\TransactionRegistrationAndUpdateCertificateMetadata',
            'relays' => ['array', '\Blockfrost\Transaction\TransactionRegistrationAndUpdateCertificateRelay']
        ];
        
        return $this->resp_from_json($resp, ['array', $a] );
    }
    
    public function getTransactionStakePoolRetirementCertificates($hash):array
    {
        $resp = $this->get("/txs/{$hash}/pool_retires");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionRetirementCertificate'] );
    }
    
    public function getTransactionMetadata($hash):array
    {
        $resp = $this->get("/txs/{$hash}/metadata");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMetadata'] );
        
        
    }
    
    public function getTransactionMetadataAsCBOR($hash):array
    {
        $resp = $this->get("/txs/{$hash}/metadata/cbor");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMetadataCBOR'] );
    }
    
    public function getTransactionRedeemers($hash):array
    {
        $resp = $this->get("/txs/{$hash}/redeemers");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionRedeemer'] );
    }
    
    public function submitTransaction(StreamInterface $cbor):string 
    {
        $resp = $this->post_data("/tx/submit", $cbor, ["Content-Type" => "application/cbor"]);
        
        return $this->resp_from_json($resp, 'string' );
    }
   
}








?>