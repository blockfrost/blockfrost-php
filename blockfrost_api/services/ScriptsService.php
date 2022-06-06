<?php 

namespace Blockfrost;


use OpenAPI\Client\Api\CardanoScriptsApi;
use OpenAPI\Client\Model\Script;
use OpenAPI\Client\Model\ScriptJson;
use OpenAPI\Client\Model\ScriptCbor;
use OpenAPI\Client\Model\ScriptDatum;





class ScriptsService extends Service 
{
    public function __construct($projectId)
    {
        parent::__construct($projectId);
        
        $this->api = new CardanoScriptsApi( $this->getClient(), /*config"*/);
    }
    
    public function getScripts():array //<ScriptsInner>
    {
        return $this->call( $this->api->scriptsGetAsyncWithHttpInfo() )[0]; //PAGE  
    }
    
    public function getScript(string $script_hash):Script
    {
        return $this->call( $this->api->scriptsScriptHashGetAsyncWithHttpInfo($script_hash) )[0]; 
    }
    
    public function getScriptAsJSON(string $script_hash):ScriptJson
    {
        return $this->call( $this->api->scriptsScriptHashJsonGetAsyncWithHttpInfo($script_hash) )[0];
    }
    
    public function getScriptAsCBOR(string $script_hash):ScriptCbor
    {
        return $this->call( $this->api->scriptsScriptHashCborGetAsyncWithHttpInfo($script_hash) )[0];
    }
    
    public function getScriptRedeemers(string $script_hash):array
    {
        return $this->call( $this->api->scriptsScriptHashRedeemersGetAsyncWithHttpInfo($script_hash) )[0]; //PAGE
    }
    
    public function getDatumAsJSON(string $datum_hash):ScriptDatum
    {
        return $this->call( $this->api->scriptsDatumDatumHashGetAsyncWithHttpInfo($datum_hash) )[0];
    }
  
}








?>