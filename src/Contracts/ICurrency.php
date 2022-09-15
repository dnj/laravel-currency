<?php

namespace dnj\Currency\Contracts;

use dnj\Number\Contracts\INumber;

interface ICurrency
{
    public function getID(): int;

    public function getTitle(): string;

    public function getCode(): string;

    public function getPrefix(): string;

    public function getSuffix(): string;

    public function getRoundingBehaviour(): RoundingBehaviour;

    public function getRoundingPrecision(): int;

    public function getRoundAmount(int|float|string|INumber $amount): INumber;

    public function format(int|float|string|INumber $amount, bool $round): string;
}
