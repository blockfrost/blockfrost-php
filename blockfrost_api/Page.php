<?php 

namespace Blockfrost;

class Page
{
    public function __construct(int $count = 100, int $page = 1, string $order = "asc")
    {
        $this->count = $count;
        $this->page  = $page;
        $this->order = $order;
    }
    
    private $count;
    private $page;
    private $order;
    
    public function getCount():int
    {
        return $this->count;
    }
    
    public function getPage():int
    {
        return $this->page;
    }
    
    public function getOrder():string
    {
        return $this->order;
    }
    
    public function withCount(int $count):Page
    {
        return new Page($count, $this->page, $this->order);
    }
    
    public function withPage(int $page):Page
    {
        return new Page($this->count, $page, $this->order);
    }
    
    public function withOrder(string $order):Page
    {
        return new Page($this->count, $this->page, $order);
    }
    
    public function nextPage():Page
    {
        return $this->withPage($this->getPage() + 1);
    }
    
    public function prevPage():Page
    {
        return $this->withPage($this->getPage() - 1);
    }
    
    
}






?>