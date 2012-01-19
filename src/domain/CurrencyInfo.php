<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * A domain object for information about a currency
 * 
 * @author 08002579
 */
class CurrencyInfo
{
    /**
     * @var float The exchange rate
     */
    private $rate;
    
    /**
     * @var string The currency code
     */
    private $code;
    
    /**
     * @var string The countries were the currencie is used
     */
    private $locations;
    
    /**
     * @var string Information about the currency
     */
    private $currency;
    
    /**
     *
     * @param float $rate The exchange rate
     * @param string $code The currency code
     * @param string $currency The countries were the currencie is used
     * @param string $locations Information about the currency
     */
    public function __construct($rate, $code, $currency, $locations)
    {
        $this->rate = $rate;
        $this->locations = $locations;
        $this->code = $code;
        $this->currency = $currency;
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
