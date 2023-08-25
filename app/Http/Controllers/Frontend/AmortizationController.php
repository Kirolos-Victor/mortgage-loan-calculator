<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CalculateAmortizationRequest;
use App\Repositories\AmortizationRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmortizationController extends Controller
{
    public function __construct(protected AmortizationRepository $amortizationRepository)
    {
    }

    public function index(): View
    {
        $data = $this->amortizationRepository->getAmortization();

        return view('frontend.amortization.index', compact('data'));
    }

    public function store(CalculateAmortizationRequest $request): RedirectResponse
    {
        $this->amortizationRepository->setAmortization($request->validated());

        return redirect()->route('loan-amortization-calculator');
    }
}
