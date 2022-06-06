<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoTransactionsApi;
use OpenAPI\Client\Model\TxContent;
use OpenAPI\Client\Model\TxContentUtxo;

class TransactionsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoTransactionsApi( $this->getClient(), /*config"*/);
    }
    
    public function getTransaction($hash):TxContent
    {
        return $this->call( $this->api->txsHashGetAsyncWithHttpInfo($hash) )[0]; 
    }
    
    public function getTransactionUTXOs($hash):TxContentUtxo
    {
        return $this->call( $this->api->txsHashUtxosGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionStakeAddressCertificates($hash):array
    {
        return $this->call( $this->api->txsHashStakesGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionDelegationCertificates($hash):array
    {
        return $this->call( $this->api->txsHashDelegationsGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionWithdrawals($hash):array
    {
        return $this->call( $this->api->txsHashWithdrawalsGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionMIRs($hash):array
    {
        return $this->call( $this->api->txsHashMirsGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionStakePoolUpdateCertificates($hash):array
    {
        return $this->call( $this->api->txsHashPoolUpdatesGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionStakePoolRetirementCertificates($hash):array
    {
        return $this->call( $this->api->txsHashPoolRetiresGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionMetadata($hash):array
    {
        return $this->call( $this->api->txsHashMetadataGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionMetadataAsCBOR($hash):array
    {
        return $this->call( $this->api->txsHashMetadataCborGetAsyncWithHttpInfo($hash) )[0];
    }
    
    public function getTransactionRedeemers($hash):array
    {
        return $this->call( $this->api->txsHashRedeemersGetAsyncWithHttpInfo($hash) )[0];
    }
    
    /*
    public function submitTransaction($content_type, $body)
    {
        return $this->post( $this->api->txSubmitPostRequest($content_type), $body )[0];
    }
   */
}








?>