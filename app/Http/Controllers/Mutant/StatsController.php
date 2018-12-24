<?php

namespace App\Http\Controllers\Mutant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\StatsService;

class StatsController extends Controller
{
    private $statsService;

    /**
     * @method __construct
     * @param  StatsService $statsService
     */
    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    /**
     * @method stats
     * @return [json]
     */
    public function stats()
    {
        $humans = $this->statsService->countHumans();
        $mutants = $this->statsService->countMutants();

        $ratio = $mutants / $humans;

        return response()->json(
            [
                'count_mutant_dna' => $mutants,
                'count_human_dna' => $humans,
                'ratio' => $ratio
            ],
            200
        );
    }
}
