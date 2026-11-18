<?php

use NFePHP\Common\Keys;
use PHPUnit\Framework\TestCase;

class KeysTest extends TestCase
{
    public function test_should_build_alphanumeric_access_key()
    {
        $key = Keys::build(
            '52',
            '06',
            '04',
            'VL1J4ZDW000163',
            '58',
            '012',
            '000000780',
            '1',
            '26730161'
        );

        $this->assertSame('520604VL1J4ZDW000163580120000007801267301616', $key);
        $this->assertTrue(Keys::isValid($key));
    }
}
