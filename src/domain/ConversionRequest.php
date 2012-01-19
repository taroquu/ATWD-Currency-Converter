<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * A domain object for a conversion request
 * 
 * @author 08002579
 */
class ConversionRequest
{
    /**
     * @var float the amount to convert
     */
    private $amount;
    
    /**
     * @var string the from currerncy code
     */
    private $from;
    
    /**
     * @var string the to currency code
     */
    private $to;
    
    /**
     *
     * @param float $amount The amount to convert
     * @param string $from The from currency code
     * @param string $to The to currency code
     */
    public function __construct($amount, $from, $to)
    {
        $this->amount = $amount;
        $this->from = $from;
        $this->to = $to;
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
