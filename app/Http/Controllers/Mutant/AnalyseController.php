<?php

namespace App\Http\Controllers\Mutant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AnalyseService;

class AnalyseController extends Controller
{
    private $analyseService;

    /**
     * @method __construct
     * @param  AnalyseService $analyseService [description]
     */
    public function __construct(AnalyseService $analyseService)
    {
        $this->analyseService = $analyseService;
    }

    /**
     * @method analyse
     * @param  Request $request
     * @return [json]
     */
    public function analyse(Request $request)
    {
        $dna = $request->input('dna');

        $result = $this->analyseService->isMutant($dna);

        if ($result) {
            return response()->json([], 200);
        }

        return response()->json([], 403);
    }
}
