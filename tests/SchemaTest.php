<?php

use PHPUnit\Framework\TestCase;

class SchemaTest extends TestCase
{
    public function test_should_allow_alphanumeric_access_key_on_mdfe_id()
    {
        $pattern = $this->getMDFeIdPattern();
        $id = 'MDFe'
            . '411906'
            . 'ABCD12345678'
            . '90123456789012345678901234';

        $this->assertSame('MDFe[0-9]{6}[A-Z0-9]{12}[0-9]{26}', $pattern);
        $this->assertSame(48, strlen($id));
        $this->assertSame(
            1,
            preg_match('/^' . $pattern . '$/', $id)
        );
        $this->assertSame(
            0,
            preg_match('/^' . $pattern . '$/', substr($id, 0, -1) . 'A')
        );
    }

    public function test_should_keep_numeric_access_key_on_mdfe_id()
    {
        $pattern = $this->getMDFeIdPattern();
        $id = 'MDFe41190822545265000108580260000000081326846774';

        $this->assertSame(48, strlen($id));
        $this->assertSame(1, preg_match('/^' . $pattern . '$/', $id));
    }

    private function getMDFeIdPattern()
    {
        $dom = new DOMDocument();
        $dom->load(dirname(__DIR__) . '/schemes/PL_MDFe_300b/mdfeTiposBasico_v3.00.xsd');
        $xpath = new DOMXPath($dom);
        $xpath->registerNamespace('xs', 'http://www.w3.org/2001/XMLSchema');

        return $xpath->evaluate(
            'string(//xs:element[@name="infMDFe"]//xs:attribute[@name="Id"]'
            . '/xs:simpleType/xs:restriction/xs:pattern/@value)'
        );
    }
}
