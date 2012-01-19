<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Dao interface for exchange information
 * 
 * @author 08002579
 */
interface ExchangeDao
{
    /**
     * Get the last update information for a rate
     * @param string $code The 3 digit currency code
     * @return string the timestamp of the last update
     */
    function getLastUpdate($currencyCode);
    
    /**
     * Update a rate
     * @param string $code The 3 digit currency code
     * @param float $value The new value
     */
    function updateRate($code, $value);
}

?>
