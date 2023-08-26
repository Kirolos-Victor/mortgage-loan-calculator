<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateAmortizationRequest;
use App\Http\Requests\CalculateExtraRepaymentScheduleRequest;
use App\Repositories\AmortizationRepository;
use App\Repositories\ExtraRepaymentRepository;
use App\Services\LoanService;
use Illuminate\Http\JsonResponse;

class MortgageLoanController extends Controller
{
    public function __construct(
            protected LoanService $loanService,
            protected AmortizationRepository $amortizationRepository,
            protected ExtraRepaymentRepository $extraRepaymentRepository,
    ) {
    }

    public function calculateAmortization(CalculateAmortizationRequest $request): JsonResponse
    {
        $amortizationSchedule = $this->amortizationRepository->setAmortization($request->validated());

        return response()->json([
                'message' => "Amortization has been stored successfully",
                "data"    => $amortizationSchedule,
        ]);
    }

    public function calculateExtraRepaymentSchedule(CalculateExtraRepaymentScheduleRequest $request): JsonResponse
    {
        $extraRepaymentSchedule = $this->extraRepaymentRepository->setExtraRepaymentSchedule($request->validated());

        return response()->json([
                'message' => "Extra repayment schedule has been stored successfully",
                "data"    => $extraRepaymentSchedule,
        ]);
    }
}
