<?php 

namespace Blockfrost\Script;

use Blockfrost\Service;
use Blockfrost\Page;

class ScriptsService extends Service 
{
    public function __construct($network, $projectId)
    {
        parent::__construct($network, $projectId);
    }
    
    /**List of scripts.
     * @param Page $page
     * @return array
     */
    public function getScripts(Page $page = null):array //<ScriptsInner>
    {
        $resp = $this->get("/scripts", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Script\Script'] );
    }
    
    /**Information about a specific script
     * @param string $script_hash
     * @return ScriptInformation
     */
    public function getScript(string $script_hash):ScriptInformation
    {
        $resp = $this->get("/scripts/{$script_hash}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Script\ScriptInformation' );
    }
    
    /**JSON representation of a timelock script
     * @param string $script_hash
     * @return ScriptJSON
     */
    public function getScriptAsJSON(string $script_hash):ScriptJSON
    {
        $resp = $this->get("/scripts/{$script_hash}/json");
        
        return $this->resp_from_json($resp, '\Blockfrost\Script\ScriptJSON' );
    }
    
    /**CBOR representation of a plutus script
     * @param string $script_hash
     * @return ScriptCBOR
     */
    public function getScriptAsCBOR(string $script_hash):ScriptCBOR
    {
        $resp = $this->get("/scripts/{$script_hash}/cbor");
        
        return $this->resp_from_json($resp, '\Blockfrost\Script\ScriptCBOR' );
    }
    
    /**List of redeemers of a specific script
     * @param string $script_hash
     * @param Page $page
     * @return array
     */
    public function getScriptRedeemers(string $script_hash, Page $page = null):array
    {
        $resp = $this->get("/scripts/{$script_hash}/redeemers", $page);
        
        return $this->resp_from_json($resp, ['array', '\Blockfrost\Script\ScriptRedeemer' ]);
    }
    
    /**Query JSON value of a datum by its hash
     * @param string $datum_hash
     * @return ScriptDatum
     */
    public function getDatumAsJSON(string $datum_hash):ScriptDatum
    {
        $resp = $this->get("/scripts/datum/{$datum_hash}");
        
        return $this->resp_from_json($resp, '\Blockfrost\Script\ScriptDatum' );
    }
  
}








?>