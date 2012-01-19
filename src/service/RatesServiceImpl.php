<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * A implemntation of the rate service
 * 
 * @author 08002579
 */
class RatesServiceImpl implements RatesService
{
    private $exchangeDao;
    private $exchangeWsao;
    
    /**
     * Extract the wsao and the exchagne dao from the resource holder
     */
    public function __construct()
    {
        $this->exchangeDao = ResourceHolder::getResource('ExchangeDao');
        $this->exchangeWsao = ResourceHolder::getResource('ExchangeWsaoCollection');
    }
    
    /**
     * {@inheritdoc}
     */
    public function affirmRate($currencyCode)
    {
        $timeSinceLastUpdate = (time() - $this->lastUpdated($currencyCode)) / 3600;
        if($timeSinceLastUpdate>2)
        {
            $this->updateRate($currencyCode);
            return true;
        }
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function lastUpdated($currencyCode)
    {
        return $this->exchangeDao->getLastUpdate($currencyCode);
    }
    
    /**
     * {@inheritdoc}
     */
    public function updateRate($currencyCode)
    {
        $rate = $this->exchangeWsao->getExchangeRate($currencyCode);
        
        if($rate!=false)
        {
            $this->exchangeDao->updateRate($currencyCode, $rate);
        }
        else
        {
            //No up to date value could be found, even though there was no error
            throw new ConfigErrorCodeException(3100);
        }
    }
}

?>
