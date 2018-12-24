<?php

namespace App\Services;

use App\Repository\DnaRepository;

class StatsService
{
    private $dnaRepository;

    /**
     * @method __construct
     * @param  DnaRepository $dnaRepository
     */
    public function __construct(DnaRepository $dnaRepository)
    {
        $this->dnaRepository = $dnaRepository;
    }

    /**
     * @method countHumans
     * @return int
     */
    public function countHumans() : int
    {
        return $this->dnaRepository->count(0);
    }

    /**
     * @method countMutants
     * @return int
     */
    public function countMutants() : int
    {
        return $this->dnaRepository->count(1);
    }
}
