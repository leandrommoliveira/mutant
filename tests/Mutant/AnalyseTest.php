<?php

use App\Mutant\Analyse;

class AnalyseTest extends TestCase
{
    public function testEmptyForCheckRow()
    {
        $analyse = new Analyse;
        $result = $analyse->checkRows([]);

        $this->assertEquals(0, $result);
    }

    public function testNoMatchInCheckRow()
    {
        $dnas = ['ATGCGA', 'CAGTGC', 'TTTAGT', 'AGAAGG', 'ACCCTA', 'TCACTG'];

        $analyse = new Analyse;
        $result = $analyse->checkRows($dnas);

        $this->assertEquals(0, $result);
    }

    public function testMatchInCheckRow()
    {
        $dnas = ['ATGCGA', 'CAGTGC', 'TTATGT', 'AGAAGG', 'CCCCTA', 'TCACTG'];

        $analyse = new Analyse;
        $result = $analyse->checkRows($dnas);

        $this->assertEquals(1, $result);
    }

    public function testMultipleMatchesInCheckRow()
    {
        $dnas = ['AAAAAG', 'GGGGTC', 'TTTTGT', 'AGAAGG', 'CCCCTA', 'TCACTG'];

        $analyse = new Analyse;
        $result = $analyse->checkRows($dnas);

        $this->assertEquals(4, $result);
    }

    public function testEmptyForCheckColumns()
    {
        $analyse = new Analyse;
        $result = $analyse->checkColumns([]);

        $this->assertEquals(0, $result);
    }

    public function testNoMatchInCheckColumns()
    {
        $dnas = [
            'ATGCGA',
            'CAGTGC',
            'TTTAGT',
            'AGAACG',
            'ACCCTA',
            'TCACTG'
        ];

        $analyse = new Analyse;
        $result = $analyse->checkRows($dnas);

        $this->assertEquals(0, $result);
    }

    public function testMatchInCheckColumns()
    {
        $dnas = [
            'ATGCGA',
            'CAGTGC',
            'TTTAGT',
            'AGAAGG',
            'ACCCTA',
            'TCACTG'
        ];

        $analyse = new Analyse;
        $result = $analyse->checkColumns($dnas);

        $this->assertEquals(1, $result);
    }

    public function testMultipleMatchesInCheckColumn()
    {
        $dnas = [
            'ATGCGC',
            'ATGTGC',
            'ATGAGC',
            'ATGAGC',
            'ACCCTA',
            'TCACTG'
        ];

        $analyse = new Analyse;
        $result = $analyse->checkColumns($dnas);

        $this->assertEquals(5, $result);
    }

    public function testEmptyforCheckOblique()
    {
        $dnas = [];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(0, $result);
    }

    public function testNoMatchInCheckOblique()
    {
        $dnas = [
            'ATGCGC',
            'ATGCGC',
            'ATGCGC',
            'ATGCGC',
            'ATGCGC',
            'ATGCGC'
        ];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(0, $result);
    }

    public function testMatchInCheckOblique()
    {
        $dnas = [
            'ATGCGC',
            'AAGCGC',
            'ATACGC',
            'ATGAGC',
            'ATGCGC',
            'ATGCGC'
        ];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(1, $result);
    }

    public function testMultipletMatchInCheckOblique()
    {
        $dnas = [
            'ACGCGC',
            'TACGGC',
            'ATACGC',
            'ATTACG',
            'ATGTGG',
            'ATGCGC'
        ];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(4, $result);
    }

    public function testMatchInCheckObliqueBack()
    {
        $dnas = [
            'ATGCGC',
            'ACGCCC',
            'ATACGC',
            'ATCAGC',
            'ATGCGC',
            'ATGCGC'
        ];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(1, $result);
    }

    public function testMultipletMatchInCheckObliqueBack()
    {
        $dnas = [
            'ATGCGC',
            'ACGGCT',
            'ATGCTA',
            'AGCTAC',
            'ATTAGC',
            'ACACGC'
        ];
        $analyse = new Analyse;
        $result = $analyse->checkOblique($dnas);

        $this->assertEquals(4, $result);
    }
}
