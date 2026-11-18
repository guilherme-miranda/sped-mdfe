<?php

use NFePHP\MDFe\Make;
use PHPUnit\Framework\TestCase;

class MakeTest extends TestCase
{
    public function test_should_build_alphanumeric_access_key()
    {
        $make = new Make();
        $make->tagide((object) [
            'cUF' => '52',
            'tpAmb' => '2',
            'tpEmit' => '2',
            'tpTransp' => null,
            'mod' => '58',
            'serie' => '012',
            'nMDF' => '000000780',
            'cMDF' => '26730161',
            'cDV' => '0',
            'modal' => '1',
            'dhEmi' => '2006-04-15T00:00:00-03:00',
            'tpEmis' => '1',
            'procEmi' => '0',
            'verProc' => '1.0',
            'UFIni' => 'GO',
            'UFFim' => 'GO',
            'dhIniViagem' => null,
            'indCanalVerde' => null,
            'indCarregaPosterior' => null
        ]);
        $make->tagemit((object) [
            'CNPJ' => 'VL1J4ZDW000163',
            'CPF' => null,
            'IE' => '110042490114',
            'xNome' => 'EMITENTE TESTE',
            'xFant' => ''
        ]);
        $make->tagenderEmit((object) [
            'xLgr' => 'RUA TESTE',
            'nro' => '1',
            'xCpl' => null,
            'xBairro' => 'CENTRO',
            'cMun' => '5208707',
            'xMun' => 'GOIANIA',
            'CEP' => '74000000',
            'UF' => 'GO',
            'fone' => null,
            'email' => null
        ]);
        $make->tagtot((object) [
            'qCTe' => null,
            'qNFe' => null,
            'qMDFe' => null,
            'vCarga' => '1.00',
            'cUnid' => '01',
            'qCarga' => '1.0000'
        ]);

        $xml = new DOMDocument();
        $xml->loadXML($make->getXML());
        $key = '520604VL1J4ZDW000163580120000007801267301616';

        $this->assertSame($key, $make->getChave());
        $this->assertSame('MDFe' . $key, $xml->getElementsByTagName('infMDFe')->item(0)->getAttribute('Id'));
        $this->assertSame('6', $xml->getElementsByTagName('cDV')->item(0)->nodeValue);
    }
}
