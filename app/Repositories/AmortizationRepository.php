<?php

namespace App\Repositories;

use App\Interfaces\AmortizationInterface;
use App\Models\LoanAmortizationSchedule;
use App\Services\LoanService;
use Illuminate\Support\Collection;

class AmortizationRepository implements AmortizationInterface
{
    public function __construct(protected LoanService $loanService)
    {
    }

    public function getAmortization(): Collection
    {
        return LoanAmortizationSchedule::all();
    }

    public function setAmortization($data): array
    {
        $amortizationSchedule = $this->loanService->calculateAmortizationSchedule($data);
        $user = Auth()->user();
        $user->loanAmortizationSchedule()->delete();
        $user->loanAmortizationSchedule()->createMany($amortizationSchedule);

        return $amortizationSchedule;
    }
}