<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\ICurrency;
use dnj\Number\Contracts\INumber;

trait ExchangeManagerTrait
{
    public function convert(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): INumber
    {
        $exchangeRate = $this->getLastRate($counter, $base);

        return $exchangeRate->convert($amount, $round);
    }

    public function convertFormat(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): string
    {
        $exchangeRate = $this->getLastRate($counter, $base);

        return $exchangeRate->convertFormat($amount, $round);
    }
}
