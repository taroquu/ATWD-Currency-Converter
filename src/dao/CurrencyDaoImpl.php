<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Implementation of CurrencyDao
 * 
 * @author 08002579
 */
class CurrencyDaoImpl extends AbstractDao implements CurrencyDao
{
    /**
     * {@inheritdoc}
     */
    public function getAvailableCurrencyCodes()
    {
        $codes = array();
        $results = $this->query("SELECT code FROM currency");
        while ($row = $results->fetch_object())
        {
            array_push($codes, $row->code);
        }
        return $codes;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getInfoFor($code)
    {
        $result = $this->query(sprintf("SELECT c.*, e.exchange_value FROM currency c INNER JOIN exchange e ON e.currency_code = c.code WHERE c.code = '%s';", $code));
        while ($row = $result->fetch_object())
        {
            return new CurrencyInfo($row->exchange_value, $row->code, ucwords($row->currency), $row->location);
        }
    }
}

?>
