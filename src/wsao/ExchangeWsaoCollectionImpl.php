<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */


/**
 * A collection of exchange WSAO's that can be utilised as though there was only
 * one of them. Allowing a failure in one of the internal WSAO's to fallback on
 * another
 *
 * @author 08002579
 */
class ExchangeWsaoCollectionImpl implements ExchangeWsao
{
    private $exchangeWsaos = array();
    
    /**
     * Extract all wsao's from the resource holder
     */
    public function __construct()
    {
        array_push($this->exchangeWsaos, ResourceHolder::getResource('YahooExchangeWsao'));
        array_push($this->exchangeWsaos, ResourceHolder::getResource('CoinmillWsao'));
        array_push($this->exchangeWsaos, ResourceHolder::getResource('FXExchangeWsao'));
    }
    
    /**
     * {@inheritdoc}
     * Iterate through each wsao until a rate is returned for the given value
     * @return mixed The rate or false if none could be found
     */
    public function getExchangeRate($currencyCode)
    {
        //usd and the 2 test currencies always have fixed rates
        $fixedRates = array('USD' => 1, 'XTS' => 0.25 , 'XXX' => 0.5);
        if(array_key_exists($currencyCode, $fixedRates))
        {
            return $fixedRates[$currencyCode];
        }
        
        foreach($this->exchangeWsaos as $index => $wsao)
        {
            try
            {
                $rate = $wsao->getExchangeRate($currencyCode);
                if($rate!=false)
                {
                    //A rate was found
                    return $rate;
                }
            }
            catch(Exception $ex)
            {
                if(count($this->exchangeWsaos)-1==$index)
                {
                    //This is the last wsao to try and no rate was found, re throw
                    throw $ex;
                }
            }
        }
        //No rate was found
        return false;
    }
}

?>
