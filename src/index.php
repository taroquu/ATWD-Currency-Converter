<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * The location of the config file
 */
define("CONFIG_FILE", 'config/config.xml');

//Set the content type to xml
header('Content-type: text/xml');

require_once('handlers/AutoLoader.php');
require_once('handlers/ErrorHandler.php');

new ErrorHandler();
$autoLoader = new AutoLoader(__DIR__.'\\');
$service = ResourceHolder::getResource('ConversionService');
$request = $service->createFromQueryString();
$response = $service->convertCurrency($request);
echo CurrencyXMLHelper::getResponseXML($response);

?>
