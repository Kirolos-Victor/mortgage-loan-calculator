<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateAmortizationRequest;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MortgageLoanController extends Controller
{
    public function __construct(protected LoanService $loanService)
    {
    }

    public function calculateAmortization(CalculateAmortizationRequest $request): JsonResponse
    {
        $amortizationSchedule = $this->loanService->calculateAmortizationSchedule($request->validated());

        return response()->json([
                'message' => "Amortization has been stored successfully",
                "data"    => $amortizationSchedule,
        ]);
    }
}
