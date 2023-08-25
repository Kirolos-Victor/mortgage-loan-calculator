<?php

namespace App\Providers;

use App\Interfaces\AmortizationInterface;
use App\Repositories\AmortizationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(AmortizationInterface::class, AmortizationRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
