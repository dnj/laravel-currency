<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\ICurrencyManager;
use dnj\Currency\Contracts\IExchangeManager;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/currency.php', 'currency');
        $this->app->singleton(ICurrencyManager::class, CurrencyManager::class);
        $this->app->singleton(IExchangeManager::class, ExchangeManager::class);
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/currency.php' => config_path('currency.php'),
            ], 'config');
        }
    }
}
