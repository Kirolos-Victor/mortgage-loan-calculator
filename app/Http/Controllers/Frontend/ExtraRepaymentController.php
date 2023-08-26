<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateExtraRepaymentScheduleRequest;
use App\Repositories\ExtraRepaymentRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExtraRepaymentController extends Controller
{
    public function __construct(protected ExtraRepaymentRepository $extraRepaymentRepository)
    {
    }

    public function index(): View
    {
        $data = $this->extraRepaymentRepository->getExtraRepaymentSchedule();

        return view('frontend.repayment.index', compact('data'));
    }

    public function store(CalculateExtraRepaymentScheduleRequest $request): RedirectResponse
    {
        $this->extraRepaymentRepository->setExtraRepaymentSchedule($request->validated());

        return redirect()->route('extra-repayment-calculator');
    }
}
