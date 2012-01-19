<?php

/**
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Implementation of Exchange Dao
 * 
 * @author 08002579
 */
class ExchangeDaoImpl extends AbstractDao implements ExchangeDao
{
    /**
     * {@inheritdoc}
     */
    public function getLastUpdate($currencyCode)
    {
        $result = $this->query(sprintf("SELECT UNIX_TIMESTAMP(lastupdate) AS lastupdate from exchange WHERE currency_code = '%s';", $currencyCode));
        while ($row = $result->fetch_object())
        {
            return $row->lastupdate;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function updateRate($code, $value, $time = null)
    {
        if($time==null)
        {
            $time = 'NOW()';
        }
        else
        {
            $time = sprintf('FROM_UNIXTIME(%s)', $time);
        }
        $this->update(sprintf("UPDATE exchange SET exchange_value = '%s', lastupdate = %s WHERE currency_code = '%s';", $value, $time, $code));
    }
}

?>
