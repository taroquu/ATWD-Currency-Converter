<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Dao interface for currency information
 * @author 08002579
 */
interface CurrencyDao
{
    /**
     * Get the currency codes supported
     * @return array An arry of the supported codes
     */
    function getAvailableCurrencyCodes();
    
    /**
     * Get the information about the currency
     * @param string $code The 3 digit currency code
     * @return CurrencyInfo Info about the currency
     */
    function getInfoFor($code);
}

?>
