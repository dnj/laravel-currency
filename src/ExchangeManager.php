<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\ICurrency;
use dnj\Currency\Contracts\IExchangeManager;
use dnj\Currency\Contracts\IExchangeRate;
use dnj\Currency\Models\Currency;
use dnj\Currency\Models\ExchangeRate;
use dnj\Number\Contracts\INumber;
use Illuminate\Database\Eloquent\Collection;
use TypeError;

class ExchangeManager implements IExchangeManager
{
    use ExchangeManagerTrait;

    public function getRateByID(int $id): ExchangeRate
    {
        return ExchangeRate::query()->findOrFail($id);
    }

    public function createRate(int|ICurrency $counter, int|ICurrency $base, INumber $rate): ExchangeRate
    {
        $this->ensureCurrencyModelType($counter);
        $this->ensureCurrencyModelType($base);

        $model = new ExchangeRate();
        $model->base_id = is_object($base) ? $base->getID() : $base;
        $model->counter_id = is_object($counter) ? $counter->getID() : $counter;
        $model->time = time();
        $model->rate = $rate;
        $model->save();

        return $model;
    }

    public function deleteRate(int|IExchangeRate $rate): void
    {
        if ($rate instanceof IExchangeRate) {
            if (!$rate instanceof ExchangeRate) {
                throw new TypeError('rate is not instance of '.ExchangeRate::class);
            }
            $rate->delete();

            return;
        }

        $rate = $this->getRateByID($rate);
        $rate->delete();
    }

    public function getLastRate(int|ICurrency $counter, int|ICurrency $base): ExchangeRate
    {
        $this->ensureCurrencyModelType($counter);
        $this->ensureCurrencyModelType($base);
    
        $counter = $this->getCurrencyId($counter);
        $base = $this->getCurrencyId($base);

        return ExchangeRate::query()
            ->where('base_id', $base)
            ->where('counter_id', $counter)
            ->orderByDesc('id')
            ->firstOrFail();
    }

    /**
     * @return Collection<ExchangeRate>
     */
    public function getRates(int|ICurrency $counter, int|ICurrency $base): iterable
    {
        $this->ensureCurrencyModelType($counter);
        $this->ensureCurrencyModelType($base);

        $counter = $this->getCurrencyId($counter);
        $base = $this->getCurrencyId($base);

        return ExchangeRate::query()
            ->where('base_id', $base)
            ->where('counter_id', $counter)
            ->orderByDesc('id')
            ->get();
    }

    public function ensureCurrencyModelType(int|ICurrency $currency): void {
        if ($currency instanceof ICurrency and !$currency instanceof Currency) {
            throw new TypeError('currency is not instance of ' . Currency::class);
        }
    }
}
