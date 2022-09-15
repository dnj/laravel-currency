<?php

namespace dnj\Currency;

use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Number\Contracts\INumber;
use dnj\Number\Number;

trait CurrencyTrait
{
    public function getRoundAmount(int|float|string|INumber $amount): INumber
    {
        $amount = Number::fromInput($amount);
        $precision = pow(10, $this->getRoundingPrecision());
        $amount = $amount->mul($precision, 1)->getValue();
        switch ($this->getRoundingBehaviour()) {
            case RoundingBehaviour::CEIL:
                $amount = ceil($amount);
                break;
            case RoundingBehaviour::ROUND:
                $amount = round($amount);
                break;
            case RoundingBehaviour::FLOOR:
                $amount = floor($amount);
                break;
        }
        $amount = Number::fromInt($amount)->div($precision, max(0, $this->getRoundingPrecision()));

        return $amount;
    }

    public function format(int|float|string|INumber $amount, bool $round): string
    {
        if ($round) {
            $amount = $this->getRoundAmount($amount);
        }
        $text = strval($amount);
        $prefix = $this->getPrefix();
        $suffix = $this->getSuffix();
        if (!$prefix and !$suffix) {
            $suffix = $this->getTitle();
        }
        if ($prefix) {
            $text = $prefix.' '.$text;
        }
        if ($suffix) {
            $text .= ' '.$suffix;
        }

        return $text;
    }
}
