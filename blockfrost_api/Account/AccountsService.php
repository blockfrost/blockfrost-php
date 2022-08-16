<?php 

namespace Blockfrost\Account;



use Blockfrost\Service;
use Blockfrost\Page;


class AccountsService extends Service 
{
    public function __construct(string $network, string $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**Obtain information about a specific stake account.
     * @param string $stake_address
     * @return AccountContent
     */
    public function getAccount(string $stake_address):AccountContent
    {
        $resp = $this->get("/accounts/{$stake_address}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Account\AccountContent');
       
    }
    
    /**Obtain information about the reward history of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountRewardHistory(string $stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/rewards", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRewardHistory']);
    }
    
    /**Obtain information about the history of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountHistory(string $stake_address, Page $page = null):array // <AccountHistoryContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/history", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountHistory']);
    }
    
    /**Obtain information about the delegation of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountDelegationHistory(string $stake_address, Page $page = null):array // <AccountDelegationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/delegations", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountDelegationHistory']);
    }
    
    /**Obtain information about the registrations and deregistrations of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountRegistrationHistory(string $stake_address, Page $page = null):array // <AccountRegistrationContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/registrations", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountRegistrationHistory']);
    }
    
    /**Obtain information about the withdrawals of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountWithdrawalHistory( string $stake_address, Page $page = null):array 
    {
        $resp = $this->get("/accounts/{$stake_address}/withdrawals", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountWithdrawalHistory']);
    }
    
    /**Obtain information about the MIRs of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountMirHistory(string $stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/mirs", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountMirHistory']);
    }
    
    /**Obtain information about the addresses of a specific account.
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountAssociatedAddresses(string $stake_address, Page $page = null):array //<AccountAddressesContentInner>
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountAssociatedAddress']);
    }
    
    /**Assets associated with the account addresses
     * @param string $stake_address
     * @param Page $page
     * @return array
     */
    public function getAccountAssociatedAssets(string $stake_address, Page $page = null):array
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses/assets", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Account\AccountAsset']);
    }
    
    /**Obtain summed details about all addresses associated with a given account. Be careful, as an account could be part of a mangled address and does not necessarily mean the addresses are owned by user as the account.
     * @param string $stake_address
     * @return \Blockfrost\Account\AccountTotal
     */
    public function getAccountAssociatedAddressesTotal(string $stake_address):\Blockfrost\Account\AccountTotal
    {
        $resp = $this->get("/accounts/{$stake_address}/addresses/total");

        return $this->resp_from_json($resp,  
                                                ['_kind' => 'object',
                                                 '_type' => '\Blockfrost\Account\AccountTotal',
                                                 'stake_address' => 'string',
                                                 'received_sum' => ['array', '\Blockfrost\Account\AccountSum'],
                                                 'sent_sum' => ['array', '\Blockfrost\Account\AccountSum'],
                                                 'tx_count' => 'int'
                                               ] );
    }
    
    
}











