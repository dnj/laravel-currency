<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\ICurrencyManager;
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyManager implements ICurrencyManager
{
    public function getByID(int $id): Currency
    {
        return Currency::query()->findOrFail($id);
    }

    public function firstByCode(string $code): Currency
    {
        return Currency::query()->where('code', $code)->firstOrFail();
    }

    /**
     * @return Collection<ICurrency>
     */
    public function findByCode(string $code): Collection
    {
        return Currency::query()->where('code', $code)->get();
    }

    /**
     * @return Collection<ICurrency>
     */
    public function getAll(): Collection
    {
        return Currency::query()->get();
    }

    public function create(
        string $code,
        string $title,
        string $prefix,
        string $suffix,
        RoundingBehaviour $roundingBehaviour,
        int $roundingPrecision,
    ): Currency {
        $currency = new Currency();
        $currency->code = $code;
        $currency->title = $title;
        $currency->prefix = $prefix;
        $currency->suffix = $suffix;
        $currency->rounding_behaviour = $roundingBehaviour;
        $currency->rounding_precision = $roundingPrecision;
        $currency->save();

        return $currency;
    }

    public function delete(int $id): void
    {
        $currency = $this->getByID($id);
        $currency->delete();
    }
}
