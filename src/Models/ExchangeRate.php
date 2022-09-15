<?php

namespace dnj\Currency\Models;

use dnj\Currency\Contracts\IExchangeRate;
use dnj\Currency\ExchangeRateTrait;
use dnj\Number\Contracts\INumber;
use dnj\Number\Laravel\Casts\Number;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model implements IExchangeRate
{
    use ExchangeRateTrait;

    public $timestamps = false;

    protected $casts = [
        'rate' => Number::class,
    ];

    public function base()
    {
        return $this->belongsTo(Currency::class);
    }

    public function counter()
    {
        return $this->belongsTo(Currency::class);
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getBaseId(): int
    {
        return $this->base_id;
    }

    public function getCounterId(): int
    {
        return $this->counter_id;
    }

    public function getBase(): Currency
    {
        return $this->base;
    }

    public function getCounter(): Currency
    {
        return $this->counter;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function getRate(): INumber
    {
        return $this->rate;
    }
}
