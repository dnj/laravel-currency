<?php

namespace dnj\Currency\Contracts;

use dnj\Number\Contracts\INumber;

interface IExchangeManager
{
    public function getRateByID(int $id): IExchangeRate;

    public function createRate(int|ICurrency $counter, int|ICurrency $base, INumber $rate): IExchangeRate;

    public function deleteRate(int|IExchangeRate $rate): void;

    public function getLastRate(int|ICurrency $counter, int|ICurrency $base): IExchangeRate;

    /**
     * @return iterable<IExchangeRate>
     */
    public function getRates(int|ICurrency $counter, int|ICurrency $base): iterable;

    public function convert(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): INumber;

    /**
     * @param int|float|numeric-string $amount
     *
     * @return numeric-string
     */
    public function convertFormat(int|float|string|INumber $amount, int|ICurrency $counter, int|ICurrency $base, bool $round = true): string;
}
