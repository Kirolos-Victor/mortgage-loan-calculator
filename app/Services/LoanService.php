<?php

namespace App\Services;

class LoanService
{
    public function calculateAmortizationSchedule(array $loanData): array
    {
        $loanAmount = $loanData['loan_amount'];
        $monthlyInterestRate = $loanData['annual_interest_rate'] / 12 / 100;
        $numberOfMonths = $loanData['loan_term'] * 12;
        $monthlyPayment = ($loanAmount * $monthlyInterestRate) / (1 - (1 + $monthlyInterestRate) ** (-$numberOfMonths));
        $monthlyExtraRepayment = $loanData['extra_repayment'] ?? 0;

        $amortizationSchedule = [];
        $remainingBalance = $loanAmount;

        for ($month = 1; $month <= $numberOfMonths; $month++) {
            $interestPayment = $remainingBalance * $monthlyInterestRate;
            $principalComponent = $monthlyPayment - $interestPayment;

            if ($monthlyExtraRepayment > 0) {
                $principalComponent += $monthlyExtraRepayment;
            }

            $endingBalance = $remainingBalance - $principalComponent;
            if ($endingBalance < 0) {
                $principalComponent = $remainingBalance;
                $endingBalance = 0;
            }
            if ($remainingBalance > 0) {
                if ($monthlyExtraRepayment > 0) {
                    $totalPayment = $monthlyPayment + $monthlyExtraRepayment;
                    $remainingLoanBalance = $this->calculateRemainLoanTerm(
                            $totalPayment,
                            $monthlyInterestRate,
                            $endingBalance
                    );
                    $amortizationSchedule[] = [
                            'month_number'        => $month,
                            'starting_balance'    => $remainingBalance,
                            'monthly_payment'     => $monthlyPayment,
                            'principal_component' => $principalComponent,
                            'interest_component'  => $interestPayment,
                            'ending_balance'      => $endingBalance,
                            'extra_repayment'     => $monthlyExtraRepayment,
                            'remaining_loan_term' => $remainingLoanBalance,
                    ];
                } else {
                    $amortizationSchedule[] = [
                            'month_number'        => $month,
                            'starting_balance'    => $remainingBalance,
                            'monthly_payment'     => $monthlyPayment,
                            'principal_component' => $principalComponent,
                            'interest_component'  => $interestPayment,
                            'ending_balance'      => $endingBalance,
                    ];
                }
            }
            $remainingBalance = $endingBalance;
        }

        return $amortizationSchedule;
    }

    private function calculateRemainLoanTerm(
            $totalPayment,
            $monthlyInterestRate,
            $endingBalance
    ): float {
        $numerator = log($totalPayment / ($totalPayment - $monthlyInterestRate * $endingBalance));
        $denominator = log(1 + $monthlyInterestRate);

        $remainingMonths = -($numerator / $denominator);

        return ceil(-$remainingMonths);
    }

}

