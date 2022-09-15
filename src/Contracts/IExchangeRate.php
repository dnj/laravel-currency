<?php

namespace dnj\Currency\Contracts;

use dnj\Number\Contracts\INumber;

interface IExchangeRate
{
    public function getID(): int;

    public function getBaseId(): int;

    public function getBase(): ICurrency;

    public function getCounterId(): int;

    public function getCounter(): ICurrency;

    public function getTime(): int;

    public function getRate(): INumber;

    public function convert(int|float|string|INumber $amount, bool $round = true): INumber;

    public function convertFormat(int|float|string|INumber $amount, bool $round = true): string;
}
