<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Currency exchange rate wsao.
 * Implemntations are responsable for returning the rate for a currency code for 1 USD
 * @author 08002579
 */
interface ExchangeWsao
{
    /**
     * Locate the latest exchanage rate for the given currency code to 1 USD
     * @param string $currencyCode The currency code to find the exchange rate for
     * @return float the latest rate 
     */
    function getExchangeRate($currencyCode);
}

?>
