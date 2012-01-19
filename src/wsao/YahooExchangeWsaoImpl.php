<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * An implementation of the exchange wsa for the yahoo finance feed
 * working through YQL
 * 
 * @author 08002579
 */
class YahooExchangeWsaoImpl extends AbstractWsao implements ExchangeWsao
{
    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($currencyCode)
    {
        $url = str_replace('{CODE}', $currencyCode, ConfigHolder::getConfig()->feeds->yahoo);
        foreach($this->request($url)->results->rate as $it)
        {
            if($it->Rate==0)
            {
                return;
            }
            return $it->Rate;
        }
    }
}

?>
