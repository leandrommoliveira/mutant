<?php

namespace App\Validator;

class DnaValidator
{
    const PATTERN = '/[^ACGT]/';

    /**
     * @method validate
     * @param  array $dna
     * @return bool
     */
    public function validate(array $dna) : bool
    {
        $match = null;
        $dna = implode('', $dna);

        if (empty($dna)) {
            return false;
        }

        preg_match(self::PATTERN, $dna, $match);

        if ($match) {
            return false;
        }

        return true;
    }
}
