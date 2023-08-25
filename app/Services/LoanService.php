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

        $amortizationSchedule = [];
        $remainingBalance = $loanAmount;

        for ($month = 1; $month <= $numberOfMonths; $month++) {
            $interestPayment = $remainingBalance * $monthlyInterestRate;
            $principalComponent = $monthlyPayment - $interestPayment;

            //extra monthly payment
            $endingBalance = $remainingBalance - $principalComponent;
            if ($endingBalance < 0) {
                $principalComponent = $remainingBalance;
                $endingBalance = 0;
            }
            if ($remainingBalance > 0) {
                $amortizationSchedule[] = [
                        'month_number'        => $month,
                        'starting_balance'    => $remainingBalance,
                        'monthly_payment'     => $monthlyPayment,
                        'principal_component' => $principalComponent,
                        'interest_component'  => $interestPayment,
                        'ending_balance'      => $endingBalance,
                ];
            }

            $remainingBalance = $endingBalance;
        }

        return $amortizationSchedule;
    }

}

