<?php

namespace App\Services;

use App\Mutant\MutantInterface;
use App\Mutant\Analyse;
use App\Repository\DnaRepository;
use App\Validator\DnaValidator;
use Cache;

class AnalyseService
{
    private $analyse;
    private $validator;
    private $dnaRepository;

    /**
     * @method __construct
     * @param  MutantInterface $analyse
     * @param  DnaValidator    $validator
     * @param  DnaRepository   $dnaRepository
     */
    public function __construct(
        MutantInterface $analyse,
        DnaValidator $validator,
        DnaRepository $dnaRepository
    ) {
        $this->validator = $validator;
        $this->analyse = $analyse;
        $this->dnaRepository = $dnaRepository;
    }

    /**
     * @method isMutant
     * @param  array $dna
     * @return bool
     */
    public function isMutant(array $dna) : bool
    {
        if (!$this->validator->validate($dna)) {
            return false;
        }

        $dnaString = md5(implode('', $dna));

        $mutant = $this->findDna($dnaString);

        if ($mutant) {
            return $mutant->mutant == 1;
        }

        $result = $this->analyse->isMutant($dna);

        $mutant = $result ? 1 : 0;

        $this->dnaRepository->insert(
            [
                'id' => $dnaString,
                'mutant' => $mutant
            ]
        );

        Cache::forget('countHumans');
        Cache::forget('countMutants');

        return $result;
    }

    public function findDna(string $dna)
    {
        if (Cache::has('dna-' . $dna)) {
            $mutant = new \stdClass;
            $mutant->mutant = Cache::get('dna-' . $dna);
            return $mutant;
        }

        $mutant = $this->dnaRepository->find($dna);

        if ($mutant) {
            Cache::forever('dna-' . $dna, $mutant->mutant);
        }
        
        return $mutant;
    }
}
