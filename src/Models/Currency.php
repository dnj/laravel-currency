<?php

namespace dnj\Currency\Models;

use dnj\Currency\Contracts\ICurrency;
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\CurrencyTrait;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model implements ICurrency
{
    use CurrencyTrait;

    public function getID(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function getSuffix(): string
    {
        return $this->suffix;
    }

    public function getRoundingBehaviour(): RoundingBehaviour
    {
        return $this->rounding_behaviour;
    }

    public function getRoundingPrecision(): int
    {
        return $this->rounding_precision;
    }
}
