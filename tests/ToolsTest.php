<?php

use NFePHP\Common\Certificate;
use NFePHP\MDFe\Common\Tools;
use PHPUnit\Framework\TestCase;

class ToolsTest extends TestCase
{
    public function test_should_use_configured_schema()
    {
        $tools = $this->makeTools('PL_MDFe_300b');

        $this->assertSame('PL_MDFe_300b', $tools->config->schemes);
        $this->assertStringEndsWith('/schemes/PL_MDFe_300b/', $tools->pathschemes);
    }

    public function test_should_use_default_schema_when_none_is_configured()
    {
        $tools = $this->makeTools();

        $this->assertSame('PL_MDFe_300a', $tools->config->schemes);
        $this->assertStringEndsWith('/schemes/PL_MDFe_300a/', $tools->pathschemes);
    }

    private function makeTools($scheme = null)
    {
        $config = [
            'versao' => '3.00',
            'siglaUF' => 'SP',
            'tpAmb' => 2
        ];
        if ($scheme !== null) {
            $config['schemes'] = $scheme;
        }

        $certificate = $this->createMock(Certificate::class);
        $certificate->method('getCnpj')->willReturn('12345678000195');

        return new Tools(json_encode($config), $certificate);
    }
}
