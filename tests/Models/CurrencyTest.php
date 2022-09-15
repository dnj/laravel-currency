<?php

namespace dnj\Currency\Tests\Models;

use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\Models\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function test()
    {
        $IRR = new Currency();
        $IRR->id = 5;
        $IRR->title = 'Rial';
        $IRR->code = 'IRR';
        $IRR->prefix = '';
        $IRR->suffix = '';
        $IRR->rounding_behaviour = RoundingBehaviour::CEIL;
        $IRR->rounding_precision = -2;

        $this->assertSame(5, $IRR->getID());
        $this->assertSame('IRR', $IRR->getCode());

        $this->assertSame(10200, $IRR->getRoundAmount(10195.1)->getValue());
        $this->assertSame('10195.1 Rial', $IRR->format(10195.1, false));

        $IRR->suffix = 'ریال';
        $this->assertSame('10200 ریال', $IRR->format(10195.1, true));

        $USD = new Currency();
        $USD->title = 'Dollar';
        $USD->code = 'USD';
        $USD->prefix = '$';
        $USD->suffix = '';
        $USD->rounding_behaviour = RoundingBehaviour::ROUND;
        $USD->rounding_precision = 2;

        $this->assertSame(4.1, $USD->getRoundAmount(4.1)->getValue());
        $this->assertSame(4.16, $USD->getRoundAmount(4.156)->getValue());
        $USD->rounding_behaviour = RoundingBehaviour::FLOOR;
        $this->assertSame(4.15, $USD->getRoundAmount(4.156)->getValue());
        $this->assertSame('$ 4.15', $USD->format(4.156, true));
    }
}
