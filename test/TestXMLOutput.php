<?php

/*
 * UFCEWT-20-3  Advanced Topics in Web Development
 * 08002579
 * Restful Currency Convert Application
 */

/**
 * Tests the xml is being correctly produced from the objects.
 * 
 * @author 08002579
 */
class TestXMLOutput extends AbstractTest
{
    /**
     * Test conversion response XML
     */
    public function textResponseXML()
    {
        $conv = new ConversionResponse('100', '200', 
                new CurrencyInfo('2.3', 'AAA', 'Fictional', 'Nowhere'), 
                new CurrencyInfo('1.2', 'BBB', 'Also Fictional', 'Also Nowhere'));
        $response = CurrencyXMLHelper::getResponseXML($conv);
        $xml = simplexml_load_string($response);
        
        $this->assertEquals(1.2 / 2.3, $xml->rate);
        $this->assertEquals(date('d F Y H:i'), $xml->at);
        
        $this->assertEquals('100', $xml->from->ammount);
        $this->assertEquals('AAA', $xml->from->code);
        $this->assertEquals('Fictional', $xml->from->curr);
        $this->assertEquals('Nowhere', $xml->from->loc);
        
        $this->assertEquals('200', $xml->to->ammount);
        $this->assertEquals('BBB', $xml->to->code);
        $this->assertEquals('Also Fictional', $xml->to->curr);
        $this->assertEquals('Also Nowhere', $xml->to->loc);
    }
    
    /**
     * Test error response XML
     */
    public function testErrorXML()
    {
        $ex = new ConfigErrorCodeException(3100);
        $response = CurrencyXMLHelper::getErrorResponseXML($ex);
        
        $xml = simplexml_load_string($response);
        $attrs = $xml->conv->error->attributes();
        $this->assertEquals('3100', $attrs['code']);
        $this->assertEquals('Error in service', $xml->conv->error);
    }
}

?>
