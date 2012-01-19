<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * An implemntation of the Conversion Service
 * @autho 08002579
 */
class ConversionServiceImpl implements ConversionService
{
    /**
     * 
     * @var CurrencyDao  
     */
    private $currencyDao;
    
    /**
     *
     * @var RatesService
     */
    private $exchange;
    
    /**
     * Load DAO's from the resource holder
     */
    public function __construct()
    {
        $this->currencyDao = ResourceHolder::getResource('CurrencyDao');
        $this->exchange = ResourceHolder::getResource('RatesService');
    }
    
    /**
     * {@inheritdoc}
     */
    public function convertCurrency(ConversionRequest $conversionRequest)
    {
        $this->exchange->affirmRate($conversionRequest->to);
        $this->exchange->affirmRate($conversionRequest->from);
        
        $toInfo = $this->currencyDao->getInfoFor($conversionRequest->to);
        $fromInfo = $this->currencyDao->getInfoFor($conversionRequest->from);
        
        $baseConversion = $conversionRequest->amount / $fromInfo->rate;
        $converted = $baseConversion * $toInfo->rate;
        return new ConversionResponse($fromInfo, $toInfo, $conversionRequest->amount, round($converted, 2), $toInfo->rate / $fromInfo->rate);
    }
    
    /**
     * {@inheritdoc}
     */
    public function validateRequest(ConversionRequest $conversionRequest)
    {
        $available = $this->getAvailableCodes();

        if(!in_array($conversionRequest->to, $available)
                || !in_array($conversionRequest->from, $available))
        {
            throw new ConfigErrorCodeException(2000);
        }
        if(!is_numeric($conversionRequest->amount))
        {
            throw new ConfigErrorCodeException(1100);
        }
        if(number_format($conversionRequest->amount, 2, '.','')!=$conversionRequest->amount)
        {
            throw new ConfigErrorCodeException(2100);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function getAvailableCodes()
    {
        return $this->currencyDao->getAvailableCurrencyCodes();
    }
    
    /**
     * {@inheritdoc}
     */
    public function createFromQueryString()
    {
        $required = array("amnt", "to", "from");
        foreach($required as $parameter)
        {
            if(!array_key_exists($parameter, $_GET))
            {
                throw new ConfigErrorCodeException(1000);
            }
        }
        
        if(count($_GET)!=count($required))
        {
            throw new ConfigErrorCodeException(1100);
        }
        $request = new ConversionRequest($_GET['amnt'], strtoupper($_GET['from']), strtoupper($_GET['to']));
        $this->validateRequest($request);
        return $request;
    }
}

?>
