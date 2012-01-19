<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Service interface for converting currencies
 * @author 08002579
 */
interface ConversionService
{
    /**
     * Perform a currency conversion for the given request
     * @param ConversionRequest $conversionRequest
     * @return ConversionResponse The result of the conversion
     */
    function convertCurrency(ConversionRequest $conversionRequest);
    
    
    /**
     * Validate that the request meets all requiremnts
     * @param ConversionRequest $conversionRequest The request to validate
     */
    function validateRequest(ConversionRequest $conversionRequest);
    
    /**
     * Gets all of the currency codes supported by the applcation
     * @return array An array of codes
     */
    function getAvailableCodes();
    
    /**
     * Extract the paramters from the query string and create a conversion
     * request object
     * @return ConversionRequest The request
     */
    function createFromQueryString();
}

?>
