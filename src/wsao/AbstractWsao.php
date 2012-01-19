<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Abstract web serice access object provideing generic functionality to
 * perform requests on xml feeds
 * 
 * @author 08002579
 */
class AbstractWsao
{
    /**
     * Extract any web service related config and setup xml settings as needed
     * Currently this is just the proxy
     */
    public function __construct()
    {
        $config = ConfigHolder::getConfig();
        $context = array();
        if(!empty($config->proxy))
        {
            $context['http'] = array('proxy' => filter_var($config->proxy, FILTER_SANITIZE_STRING));
        }
        $default_context = stream_context_get_default ($context); 
        libxml_set_streams_context($default_context); 
    }
    
    /**
     * Send an HTTP request on the given URL and process into xml
     * @param string $url The url for the request
     * @return SimpleXMLElement The resulting xml response
     */
    protected function request($url)
    {
        libxml_use_internal_errors(true);
        $response = simplexml_load_file($url,'SimpleXMLElement', LIBXML_NOCDATA);
        
        if(!$response)
        {
            throw new ConfigErrorCodeException(3000);
        }
        else
        {
            return $response;
        }
    }
}

?>
