<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Helper class for formating xml output
 * 
 * @author 08002579
 */
class CurrencyXMLHelper
{
    /**
     * Produce an XML response for the given exception
     * @param Exception $exception
     * @return string The xml 
     */
    public static function getErrorResponseXML(Exception $exception)
    {
        $response = new SimpleXMLElement('<conv />');
        $error = $response->addChild('error', $exception->getMessage());
        $error->addAttribute('code', $exception->getCode());
        return $response->asXML();
    }
    
    /**
     * Produce an XML response for the given conversion response
     * @param ConversionResponse $convresponse
     * @return string The xml  
     */
    public static function getResponseXML(ConversionResponse $convresponse)
    {
        $response = new SimpleXMLElement('<conv />');
        $response->addChild('at', date('d F Y H:i'));
        $response->addChild('rate', $convresponse->rate, 2);
        self::proccessCurrencyInfo($convresponse->from, $response, 'from', $convresponse->fromAmount);
        self::proccessCurrencyInfo($convresponse->to, $response, 'to', $convresponse->toAmount);
        return $response->asXML();
    }
    
    private static function proccessCurrencyInfo(CurrencyInfo $info, SimpleXMLElement $parentElement, $nodeName, $ammount)
    {
        $xinfo = $parentElement->addChild($nodeName);
        $xinfo->addChild('code', $info->code);
        $xinfo->addChild('curr', $info->currency);
        $xinfo->addChild('loc', $info->locations);
        $xinfo->addChild('amnt', $ammount);
    }
}

?>
