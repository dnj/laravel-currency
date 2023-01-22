<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\ICurrency;
use dnj\Currency\Models\Currency;
use dnj\Number\Contracts\INumber;
use dnj\Number\Number;

trait ExchangeManagerTrait
{
    public function convert(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): INumber
    {
        if ($this->getCurrencyId($counter) == $this->getCurrencyId($base)) {
            return Number::fromInput($amount);
        }

        $exchangeRate = $this->getLastRate($counter, $base);

        return $exchangeRate->convert($amount, $round);
    }

    public function convertFormat(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): string
    {
        if ($this->getCurrencyId($counter) == $this->getCurrencyId($base)) {
            if ($counter instanceof ICurrency) {
                return $counter->format($amount, $round);
            }
            if ($base instanceof ICurrency) {
                return $base->format($amount, $round);
            }
            return Currency::query()->findOrFail($base)->format($amount, $round);
        }

        $exchangeRate = $this->getLastRate($counter, $base);

        return $exchangeRate->convertFormat($amount, $round);
    }

    public function getCurrencyId(int|ICurrency $currency): int {
        if ($currency instanceof ICurrency) {
            return $currency->getID();
        }
        return $currency;
    }
}
