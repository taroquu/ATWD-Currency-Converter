<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * An auto loader for classes
 * Registers the auto load handler and sets up an array of all the classes and 
 * their file locations
 * @author 08002579
 */
class AutoLoader
{
    /**
     *
     * @var array An array of classes and their files
     */
    private $classes = array();
    
    /**
     * Setup the array of classes and files
     * @param string $baseDir The base directory of the application
     */
    public function __construct($baseDir)
    {
        $this->classes['ResourceHolder'] = $baseDir.'service\ResourceHolder.php';
        $this->classes['ConversionServiceImpl'] = $baseDir.'service\ConversionServiceImpl.php';
        $this->classes['ConversionService'] = $baseDir.'service\ConversionService.php';
        $this->classes['CurrencyDaoImpl'] = $baseDir.'dao\CurrencyDaoImpl.php';
        $this->classes['AbstractDao'] = $baseDir.'dao\AbstractDao.php';
        $this->classes['CurrencyDao'] = $baseDir.'dao\CurrencyDao.php';
        $this->classes['ConfigHolder'] = $baseDir.'service\ConfigHolder.php';
        $this->classes['DataSource'] = $baseDir.'dao\DataSource.php';
        $this->classes['RatesServiceImpl'] = $baseDir.'service\RatesServiceImpl.php';
        $this->classes['RatesService'] = $baseDir.'service\RatesService.php';
        $this->classes['ExchangeDaoImpl'] = $baseDir.'dao\ExchangeDaoImpl.php';
        $this->classes['ExchangeDao'] = $baseDir.'dao\ExchangeDao.php';
        $this->classes['ExchangeWsaoCollectionImpl'] = $baseDir.'wsao\ExchangeWsaoCollectionImpl.php';
        $this->classes['ExchangeWsao'] = $baseDir.'wsao\ExchangeWsao.php';
        $this->classes['YahooExchangeWsaoImpl'] = $baseDir.'wsao\YahooExchangeWsaoImpl.php';
        $this->classes['AbstractWsao'] = $baseDir.'wsao\AbstractWsao.php';
        $this->classes['CoinmillWsaoImpl'] = $baseDir.'wsao\CoinmillWsaoImpl.php';
        $this->classes['FXExchangeWsaoImpl'] = $baseDir.'wsao\FXExchangeWsaoImpl.php';
        $this->classes['ConversionRequest'] = $baseDir.'domain\ConversionRequest.php';
        $this->classes['CurrencyInfo'] = $baseDir.'domain\CurrencyInfo.php';
        $this->classes['ConversionResponse'] = $baseDir.'domain\ConversionResponse.php';
        $this->classes['CurrencyXMLHelper'] = $baseDir.'service\CurrencyXMLHelper.php'; 
        $this->classes['ConfigErrorCodeException'] = $baseDir.'exceptions\ConfigErrorCodeException.php';
        $this->classes['ErrorHandler'] = $baseDir.'handlers\ErrorHandler.php';
        spl_autoload_register(array($this, "autoLoad"));
    }
    
    /**
     * Internal method for loading classes, used by spl_autoload_register 
     * 
     * This method will trigger php error on failure instead of throwing exceptions
     * as exceptions are caught internally by the php auto loader
     * 
     * @param String $className the name of the class to load
     */
    protected function autoLoad($className)
    {
        if(array_key_exists($className, $this->classes))
        {
            require_once($this->classes[$className]);
        }
    }
}

?>
