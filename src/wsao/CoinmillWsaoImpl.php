<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Web service access object for coinmill.com exchange rates feeds
 * 
 * @author 08002579
 */
class CoinmillWsaoImpl extends AbstractWsao implements ExchangeWsao
{
    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($currencyCode)
    {
        //format request url
        $url = str_replace('{CODE}', strtoupper($currencyCode), ConfigHolder::getConfig()->feeds->coinmill);
        
        //Expecting only 1 result, but a formality 
        foreach($this->request($url)->channel->item as $it)
        {
            //Need to extract from CDATA with some regexs
            $matches = null;
            preg_match(sprintf("/1.00 %s = [\\d.]*\\s*%s/", strtoupper($currencyCode), 'USD'), $it->description, $matches);
            $line = null;
            preg_match("/={1}\\s*\\d+(.{1}\\d+)?/", $matches[0], $line);
            $value = preg_replace("/=|\\s/", "", $line[0]);
            
            /* Coin mill deals as the fallback for rare currencies include some with very low values,
             * The rate of 1USD is usually 0 when round to 2dp, so the value of 1 of the request currency is
             * inverted instead
             */
            $value = 1 / filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT);
            return $value;
        }
    }
}

?>
