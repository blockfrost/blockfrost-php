<?php 

namespace Blockfrost;

//use \GuzzleHttp\Client;
use \GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\Psr7\Request;


 
abstract class Service
{
    public function __construct($projectId)
    {
        $this->projectId = $projectId;
     
        //$configuration = new Configuration();
        
        $this->client = new \GuzzleHttp\Client([ 'headers' => [ "project_id" => $projectId]  ]);
    }
    
    private   $projectId;
    private   $client;
    
    protected function getClient():\GuzzleHttp\Client
    {
        return $this->client;
    }
    
    protected function call(PromiseInterface $promise)
    {
        return  $promise->wait(); //can throw OpenApi\Client\ApiException.  Covert to a Cardano exception?
    }
    
    protected function postForJSON(Request $request, $body)
    {
        $r = $this->call( $this->client->sendAsync($request, ['body' => $body ]) );
        
        return $r->getBody();
    }
}
    
    
?>