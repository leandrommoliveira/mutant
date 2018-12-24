<?php

namespace App\Mutant;

interface MutantInterface
{
    public function isMutant(array $dna) : bool;
}
