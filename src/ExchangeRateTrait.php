<?php

namespace dnj\Currency;

use dnj\Number\Contracts\INumber;

trait ExchangeRateTrait
{
    public function convert(int|float|string|INumber $amount, bool $round = true): INumber
    {
        $amount = $this->getRate()->mul($amount);
        if ($round) {
            $amount = $this->getCounter()->getRoundAmount($amount);
        }

        return $amount;
    }

    public function convertFormat(int|float|string|INumber $amount, bool $round = true): string
    {
        $amount = $this->getRate()->mul($amount);

        return $this->getCounter()->format($amount, $round);
    }
}
