<?php

namespace App\Repository;

use App\Dna;

class DnaRepository
{
    private $dna;

    /**
     * @method __construct
     * @param  Dna $dna
     */
    public function __construct(Dna $dna)
    {
        $this->dna = $dna;
    }

    /**
     * @method insert
     * @param  array  $dna
     */
    public function insert(array $dna)
    {
        Dna::create($dna);
    }

    /**
     * @method find
     * @param  string $id
     */
    public function find(string $id)
    {
        return Dna::find($id);
    }

    /**
     * @method count
     * @param  int $type
     * @return int
     */
    public function count(int $type) : int
    {
        return Dna::where('mutant', $type)->get()->count();
    }
}
