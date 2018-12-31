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
        $stats = $this->statsService->stats();

        return response()->json(
            [
                'count_mutant_dna' => $stats['mutants'],
                'count_human_dna' => $stats['humans'],
                'ratio' => $stats['ratio']
            ],
            200
        );
    }
}
