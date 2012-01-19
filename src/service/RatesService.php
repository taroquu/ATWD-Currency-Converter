<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Service for dealing with exchange rates
 * @author 08002579
 */
interface RatesService
{
    /**
     * Locate the most recent rate for the given code and update the cached value
     * @param string $currencyCode The code to update
     */
    function updateRate($currencyCode);
    
    /**
     * Get the last update timestamp for the given currency code
     * @param string $currencyCode The code to check
     * @return string The timestamp of the last upedate
     */
    function lastUpdated($currencyCode);
    
    /**
     * Check whether the rate for the given currency needs to be updated
     * based on the last update time. Updates if it does
     * @param string $currencyCode The code to update
     * @return boolean true if the rate was updated, false otherwise
     */
    function affirmRate($currencyCode);
}

?>
