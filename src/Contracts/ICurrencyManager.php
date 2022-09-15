<?php

namespace dnj\Currency\Contracts;

interface ICurrencyManager
{
    public function getByID(int $id): ICurrency;

    public function firstByCode(string $code): ICurrency;

    /**
     * @return iterable<ICurrency>
     */
    public function findByCode(string $code): iterable;

    /**
     * @return iterable<ICurrency>
     */
    public function getAll(): iterable;

    public function create(
        string $code,
        string $title,
        string $prefix,
        string $suffix,
        RoundingBehaviour $roundingBehaviour,
        int $roundingPrecision,
    ): ICurrency;

    public function delete(int $id): void;
}
