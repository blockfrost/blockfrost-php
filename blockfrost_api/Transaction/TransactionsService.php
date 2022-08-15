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
    
    /**Return content of the requested transaction.
     * @param string $hash
     * @return Transaction
     */
    public function getTransaction(string $hash):Transaction 
    {
        $resp = $this->get("/txs/{$hash}");
        
        return $this->resp_from_json($resp,
            ['_kind' => 'object',
                '_type' => '\Blockfrost\Transaction\Transaction',
                'output_amount' => ['array', '\Blockfrost\Transaction\TransactionAmount']
            ] );
    }
    
    /**Return the inputs and UTXOs of the specific transaction.
     * @param string $hash
     * @return TransactionUTXOs
     */
    public function getTransactionUTXOs(string $hash):TransactionUTXOs
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
    
    /**Obtain information about (de)registration of stake addresses within a transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionStakeAddressCertificates(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/stakes");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionAddressCertificate'] );
    }
    
    /**Obtain information about delegation certificates of a specific transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionDelegationCertificates(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/delegations");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionDelegationCertificate'] );
    }
    
    /**Obtain information about withdrawals of a specific transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionWithdrawals(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/withdrawals");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionWithdrawal'] );
    }
    
    /**Obtain information about Move Instantaneous Rewards (MIRs) of a specific transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionMIRs(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/mirs");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMir'] );
    }
    
    /**Obtain information about stake pool registration and update certificates of a specific transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionStakePoolUpdateCertificates(string $hash):array
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
    
    /**Obtain information about stake pool retirements within a specific transaction.
     * @param string $hash
     * @return array
     */
    public function getTransactionStakePoolRetirementCertificates(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/pool_retires");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionRetirementCertificate'] );
    }
    
    /**Obtain the transaction metadata.
     * @param string $hash
     * @return array
     */
    public function getTransactionMetadata(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/metadata");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMetadata'] );
        
        
    }
    
    /**Obtain the transaction metadata in CBOR.
     * @param string $hash
     * @return array
     */
    public function getTransactionMetadataAsCBOR(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/metadata/cbor");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionMetadataCBOR'] );
    }
    
    /**Obtain the transaction redeemers.
     * @param string $hash
     * @return array
     */
    public function getTransactionRedeemers(string $hash):array
    {
        $resp = $this->get("/txs/{$hash}/redeemers");
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Transaction\TransactionRedeemer'] );
    }
    
    /**Submit an already serialized transaction to the network.
     * @param StreamInterface $cbor
     * @return string
     */
    public function submitTransaction(StreamInterface $cbor):string 
    {
        $resp = $this->post_data("/tx/submit", $cbor, ["Content-Type" => "application/cbor"]);
        
        return $this->resp_from_json($resp, 'string' );
    }
   
}








?>