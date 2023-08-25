<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateAmortizationRequest;
use App\Http\Requests\CalculateExtraRepaymentScheduleRequest;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;

class MortgageLoanController extends Controller
{
    public function __construct(protected LoanService $loanService)
    {
    }

    public function calculateAmortization(CalculateAmortizationRequest $request): JsonResponse
    {
        $amortizationSchedule = $this->loanService->calculateAmortizationSchedule($request->validated());
        $user = Auth()->user();
        $user->loanAmortizationSchedule()->delete();
        $user->loanAmortizationSchedule()->createMany($amortizationSchedule);

        return response()->json([
                'message' => "Amortization has been stored successfully",
                "data"    => $amortizationSchedule,
        ]);
    }

    public function calculateExtraRepaymentSchedule(CalculateExtraRepaymentScheduleRequest $request): JsonResponse
    {
        $extraRepaymentSchedule = $this->loanService->calculateAmortizationSchedule($request->validated());
        $user = Auth()->user();
        $user->extraRepaymentSchedule()->delete();
        $user->extraRepaymentSchedule()->createMany($extraRepaymentSchedule);

        return response()->json([
                'message' => "Extra repayment schedule has been stored successfully",
                "data"    => $extraRepaymentSchedule,
        ]);
    }
}
