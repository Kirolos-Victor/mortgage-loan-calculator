<?php

namespace App\Providers;

use App\Interfaces\AmortizationInterface;
use App\Interfaces\ExtraRepaymentInterface;
use App\Repositories\AmortizationRepository;
use App\Repositories\ExtraRepaymentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(AmortizationInterface::class, AmortizationRepository::class);
        $this->app->bind(ExtraRepaymentInterface::class, ExtraRepaymentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
