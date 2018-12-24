<?php

use App\Validator\DnaValidator;

class DnaValidatorTest extends TestCase
{
    public function testEmptyDnaValidate()
    {
        $validator = new DnaValidator;
        $dnas = [];
        $result = $validator->validate($dnas);

        $this->assertEquals(false, $result);
    }

    public function testInvalidDnaValidate()
    {
        $validator = new DnaValidator;
        $dnas = ['ATGCGA', 'CAGTGC', 'TTATGT', 'AGZAGG', 'CCCCTA', 'TCACTG'];
        $result = $validator->validate($dnas);

        $this->assertEquals(false, $result);
    }

    public function testValidDnaValidate()
    {
        $validator = new DnaValidator;
        $dnas = ['ATGCGA', 'CAGTGC', 'TTATGT', 'AGAAGG', 'CCCCTA', 'TCACTG'];
        $result = $validator->validate($dnas);

        $this->assertEquals(true, $result);
    }
}
