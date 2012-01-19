<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * A domain for a conversion response
 * 
 * @author 08002579
 */
class ConversionResponse
{
    /**
     * @var string The from code
     */
    private $from;
    
    /**
     * @var string The to code
     */
    private $to;
    
    /**
     * @var float The exchange rate
     */
    private $rate;
    
    /**
     * @var float The from amount
     */
    private $fromAmount;
    
    /**
     * @var float The converted (to) amount
     */
    private $toAmount;
    
    /**
     *
     * @param string $from The from code
     * @param string $to The to code
     * @param float $fromAmount The from amount
     * @param float $toAmount The to amount (converted amount)
     * @param float $rate The exchange rate
     */
    public function __construct($from, $to, $fromAmount, $toAmount, $rate)
    {
        $this->from = $from;
        $this->to = $to;
        $this->fromAmount = $fromAmount;
        $this->toAmount = $toAmount;
        $this->rate = $rate;
    }
    
    /** 
     * Generic getter
     * @param string $name
     */
    public function __get($name)
    {
        return $this->$name;
    }
    
    /**
     * Generic setting
     * @param string $name
     * @param mixed $value 
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}

?>
