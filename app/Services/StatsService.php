<?php

namespace App\Services;

use App\Repository\DnaRepository;
use Cache;

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
        if (Cache::has('countHumans')) {
            return Cache::get('countHumans');
        }

        $humans = $this->dnaRepository->count(0);
        Cache::forever('countHumans', $humans);

        return $humans;
    }

    /**
     * @method countMutants
     * @return int
     */
    public function countMutants() : int
    {
        if (Cache::has('countMutants')) {
            return Cache::get('countMutants');
        }

        $mutants = $this->dnaRepository->count(1);
        Cache::forever('countMutants', $mutants);

        return $mutants;
    }

    /**
     * @method stats
     * @return array [stats]
     */
    public function stats() : array
    {
        $humans = $this->countHumans();
        $mutants = $this->countMutants();

        $ratio = 0;

        if ($mutants && $humans) {
            $ratio = $mutants / $humans;
        }
        
        return [
            'humans' => $humans,
            'mutants' => $mutants,
            'ratio' => $ratio
        ];
    }
}
