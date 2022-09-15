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
        if ($counter instanceof ICurrency and !$counter instanceof Currency) {
            throw new TypeError('counter is not instance of '.Currency::class);
        }
        if ($base instanceof ICurrency and !$base instanceof Currency) {
            throw new TypeError('base is not instance of '.Currency::class);
        }
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
        if ($counter instanceof ICurrency) {
            if (!$counter instanceof Currency) {
                throw new TypeError('counter is not instance of '.Currency::class);
            }
            $counter = $counter->getID();
        }
        if ($base instanceof ICurrency) {
            if (!$base instanceof Currency) {
                throw new TypeError('base is not instance of '.Currency::class);
            }
            $base = $base->getID();
        }

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
        if ($counter instanceof ICurrency) {
            if (!$counter instanceof Currency) {
                throw new TypeError('counter is not instance of '.Currency::class);
            }
            $counter = $counter->getID();
        }
        if ($base instanceof ICurrency) {
            if (!$base instanceof Currency) {
                throw new TypeError('base is not instance of '.Currency::class);
            }
            $base = $base->getID();
        }

        return ExchangeRate::query()
            ->where('base_id', $base)
            ->where('counter_id', $counter)
            ->orderByDesc('id')
            ->get();
    }
}
