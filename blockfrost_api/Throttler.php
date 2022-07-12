<?php 

namespace Blockfrost;

class Throttler
{
    public static function create():Throttler
    {
        if( Throttler::$INSTANCE == null  )
            Throttler::$INSTANCE = new Throttler();
        
        return Throttler::$INSTANCE;
    }
    
    private static $INSTANCE = null;
    
    private static function secsNow():float
    {
        $t = hrtime(true);
        
        if( $t === false )
            throw new \Exception("High resolution time (hrtime) not supported");
        
        return $t / 1000000000.0; //nanoseconds
    }
    
    private function __construct()
    {
        $this->requestCount = 0;
        $this->lastRequestTime = Throttler::secsNow();
    }
   
    public const BURST_LIMIT                  = 500;
    public const BURST_COOLDOWN               = 10;
    public const BURST_COOLDOWN_INTERVAL_SECS = 1;
    
    private $requestCount;
    private $lastRequestTime;

    public function next()
    {
        $sesSinceLastCall = Throttler::secsNow() - $this->lastRequestTime;
            
        $cooledOffRequests = $sesSinceLastCall * Throttler::BURST_COOLDOWN;
         
        $this->requestCount = $this->requestCount > $cooledOffRequests ? $this->requestCount - $cooledOffRequests : 0;

        while ($this->requestCount >= Throttler::BURST_LIMIT)
        {
            sleep(Throttler::BURST_COOLDOWN_INTERVAL_SECS);
            
            $this->requestCount -= Throttler::BURST_COOLDOWN;
        }

        $this->lastRequestTime = Throttler::secsNow();
        $this->requestCount++;
    }
    
}
   
?>