<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Implementation of the wsao for the fxexchangerate.com feed
 * 
 * @author 08002579
 */
class FXExchangeWsaoImpl extends AbstractWsao implements ExchangeWsao
{
    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($currencyCode)
    {
        $url = str_replace('{CODE}', strtolower($currencyCode), ConfigHolder::getConfig()->feeds->fx);
        foreach($this->request($url)->channel->item as $it)
        {
            //Extract the currency code from the title
            $matches = null;
            preg_match_all("/\\({1}\\S{3}\\){1}/", $it->title, $matches);
            $code = preg_replace("/\\(|\\)/", "", $matches[0][1]);
            //Extract the currency from the descriptions
            preg_match("/={1}\\W*[0-9.]+\\W*/", $it->description, $matches);
            $value = preg_replace("/\\s/", "", str_replace("=", "", $matches[0]));
            return $value;
        }
    }
}

?>
