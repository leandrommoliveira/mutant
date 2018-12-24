<?php

namespace App\Mutant;

class Analyse implements MutantInterface
{
    const PATTERN = '/[A]{4}|[C]{4}|[G]{4}|[T]{4}/';

    /**
     * @method isMutant
     * @param  array $dna
     * @return bool
     */
    public function isMutant(array $dna) : bool
    {
        $matches = 0;

        $matches += $this->checkRows($dna);
        $matches += $this->checkColumns($dna);
        $matches += $this->checkOblique($dna);

        if ($matches > 1) {
            return true;
        }

        return false;
    }

    /**
     * @method checkRows
     * @param  array $dna
     * @return int
     */
    public function checkRows(array $dna) : int
    {
        $matches = 0;
        foreach ($dna as $value) {
            $matches += $this->checkCombination($value);
        }

        return $matches;
    }

    /**
     * @method checkColumns
     * @param  array $dna
     * @return int
     */
    public function checkColumns(array $dna) : int
    {
        $matches = 0;
        $total = count($dna);

        for ($column = 0; $column < $total; $column++) {
            $combination = '';
            foreach ($dna as $value) {
                $combination .= $value[$column];
            }

            $matches += $this->checkCombination($combination);
        }

        return $matches;
    }

    /**
    * @method checkOblique
    * @param array $dna
    * @return int
    */
    public function checkOblique(array $dna) : int
    {
        $matches = 0;

        foreach ($dna as $key => $value) {
            $size = strlen($value);

            for ($i = 0; $i < $size; $i++) {
                $combination = '';

                $combination .= isset($dna[$key][$i]) ? $dna[$key][$i] : '';
                $combination .= isset($dna[$key+1][$i+1]) ? $dna[$key+1][$i+1] : '';
                $combination .= isset($dna[$key+2][$i+2]) ? $dna[$key+2][$i+2] : '';
                $combination .= isset($dna[$key+3][$i+3]) ? $dna[$key+3][$i+3] : '';

                $matches += $this->checkCombination($combination);
            }

            for ($i = $size-1; $i > 0; $i--) {
                $combination = '';

                $combination .= isset($dna[$key][$i]) ? $dna[$key][$i] : '';
                $combination .= isset($dna[$key+1][$i-1]) ? $dna[$key+1][$i-1] : '';
                $combination .= isset($dna[$key+2][$i-2]) ? $dna[$key+2][$i-2] : '';
                $combination .= isset($dna[$key+3][$i-3]) ? $dna[$key+3][$i-3] : '';

                $matches += $this->checkCombination($combination);
            }
        }

        return $matches;
    }

    /**
     * @method checkCombination
     * @param  string $combination
     * @return int
     */
    public function checkCombination(string $combination) : int
    {
        $match = 0;

        if (strlen($combination) < 4) {
            return 0;
        }

        preg_match(self::PATTERN, $combination, $match);

        if ($match) {
            return 1;
        }

        return 0;
    }
}
