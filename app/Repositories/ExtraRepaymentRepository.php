<?php

namespace App\Repositories;

use App\Interfaces\ExtraRepaymentInterface;
use App\Models\ExtraRepaymentSchedule;
use App\Services\LoanService;
use Illuminate\Support\Collection;

class ExtraRepaymentRepository implements ExtraRepaymentInterface
{
    public function __construct(protected LoanService $loanService)
    {
    }

    public function getExtraRepaymentSchedule(): Collection
    {
        return ExtraRepaymentSchedule::all();
    }

    public function setExtraRepaymentSchedule($data): array
    {
        $extraRepaymentSchedule = $this->loanService->calculateAmortizationSchedule($data);
        $user = Auth()->user();
        $user->extraRepaymentSchedule()->delete();
        $user->extraRepaymentSchedule()->createMany($extraRepaymentSchedule);

        return $extraRepaymentSchedule;
    }
}