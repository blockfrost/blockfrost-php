<?php 

namespace Blockfrost;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

 
abstract class Service
{
    public function __construct($network, $projectId)
    {
        $this->network = $network;
        $this->projectId = $projectId;
     
        //$configuration = new Configuration();
        
        $this->client = new \GuzzleHttp\Client([ 'headers' => [ "project_id" => $projectId]  ]);
        
        $this->throttler = Throttler::create(); 
    }
    
    private $throttler;
    
    private $network;
    private $projectId;
    private $client;
    
    public static $NETWORK_IPFS            = "https://ipfs.blockfrost.io/api/v0";
    public static $NETWORK_CARDANO_MAINNET = "https://cardano-mainnet.blockfrost.io/api/v0";
    public static $NETWORK_CARDANO_TESTNET = "https://cardano-testnet.blockfrost.io/api/v0";
	public static $NETWORK_CARDANO_PREPROD = "https://cardano-preprod.blockfrost.io/api/v0";
	public static $NETWORK_CARDANO_PREVIEW = "https://cardano-preview.blockfrost.io/api/v0";
    
    
    
    //---------- Rest interface methods ----------------------------------------
    
    private function addQuery(string $endpoint, Page $page = null, array $params = null):string
    {
        if( ! $page && (! $params || count($params) == 0) )
            return $endpoint;
            
        $out = $endpoint."?";
        
        $tail = false;
        
        if( $page )
        {
            $out .= "count=".$page->getCount()."&page=".$page->getPage()."&order=".$page->getOrder();
            $tail = true;
        }

        if( $params )
        {
            foreach($params as $key => $value)
            {
                if( $tail )
                    $out .= "&";
                
                $out .= $key . "=" . $value;
                    
                $tail = true;
            }
                
        }
        
        return $out;
    }
    
    protected function getClient():\GuzzleHttp\Client
    {
        return $this->client;
    }
    
    protected function get($endpoint, Page $page = null, array $params = null):ResponseInterface
    {
        $endpoint = $this->addQuery($endpoint, $page, $params);
        
        $this->throttler->next();
        
        return $this->getClient()->request("GET", $this->network . $endpoint);
    }
    
    protected function post_void($endpoint):ResponseInterface
    {
        $this->throttler->next();
        
        return $this->getClient()->request("POST", $this->network . $endpoint);
    }
    
    protected function post_data($endpoint, $data, $headers = []):ResponseInterface
    {
        $this->throttler->next();
        
        return $this->getClient()->request("POST", $this->network . $endpoint, ['body' => $data, 'headers' => $headers] );
    }
    
    protected function post_file($endpoint, $name, StreamInterface $stream):ResponseInterface
    {
        $this->throttler->next();
        
        return $this->getClient()->request("POST", $this->network.$endpoint,
            [
                'multipart' => [[
                    'name' => "file",
                    'contents' => $stream,
                    'filename' => $name
                ]]
            ]);
    }
    
    private function object_from_json($json, $info) // [ [kind="array", type="Address"],                ['string'] 
    {
        $instance = null;
        
        if( is_array($info) )
        {
            if( isset($info[0]) )
            {
                $instance = [];
                
                foreach($json as $jsonItem)
                {
                    $instance[] = $this->object_from_json($jsonItem, $info[1] );
                }
            }
            
            else 
            {
                switch($info["_kind"]) {
                    
                    case "array":
                    
                        $instance = [];
                        
                        foreach($json as $jsonItem)
                        {
                            $instance[] = $this->object_from_json($jsonItem, $info["_type"] );
                        }
    
                    break;
                    
                    case "object":
                    
                        $instance = new $info["_type"];
                    
                        foreach ($json as $key => $val)
                        {
                            if( property_exists($instance, $key) )
                                $instance->$key = $this->object_from_json($val, isset($info[$key])? $info[$key]: 'mixed');
                        }
                                   
                        break;
                    
                    default: throw new \Exception();
                }
            }
        }
        
        else
        {        
            if( $info == "string" || $info == "int" || $info == "boolean" || $info == "mixed" )  //bool, number..
                $instance = $json;
         
           else
           {
                $instance = new $info;
                    
                foreach ($json as $key => $val)
                {
                    if( property_exists($instance, $key) )
                        $instance->$key = $val;
                }
                    
                return $instance;
            }
        }
        
        
        return $instance;
    }
    
    protected function resp_from_json(ResponseInterface $res, $info)
    {
        $json = json_decode((string) $res->getBody(), true);
        
        return $this->object_from_json($json, $info, 0);
    }
    
    protected function resp_stream(ResponseInterface $res):StreamInterface
    {
        return $res->getBody();
    }
    

    //-------------------- Static helper methods ----------------------------
    
    public static function readStreamAsString(StreamInterface $stream):string
    {
        return $stream->getContents();
    }
    
    public static function streamFromString(string $s):StreamInterface
    {
        return \GuzzleHttp\Psr7\Utils::streamFor($s);
    }
    
}
    
    
?>