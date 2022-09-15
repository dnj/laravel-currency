<?php

namespace dnj\Currency\Tests\Models;

use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\Models\Currency;
use dnj\Currency\Models\ExchangeRate;
use dnj\Number\Number;
use PHPUnit\Framework\TestCase;

class ExchangeRateTest extends TestCase
{
    public function test()
    {
        $IRR = new Currency();
        $IRR->id = 5;
        $IRR->title = 'Rial';
        $IRR->code = 'IRR';
        $IRR->prefix = '';
        $IRR->suffix = 'ریال';
        $IRR->rounding_behaviour = RoundingBehaviour::CEIL;
        $IRR->rounding_precision = -2;

        $USD = new Currency();
        $USD->id = 6;
        $USD->title = 'Dollar';
        $USD->code = 'USD';
        $USD->prefix = '$';
        $USD->suffix = '';
        $USD->rounding_behaviour = RoundingBehaviour::ROUND;
        $USD->rounding_precision = 2;

        $time = time() - 50;
        $USDIRR = new ExchangeRate();
        $USDIRR->id = 1;
        $USDIRR->base_id = 5;
        $USDIRR->base = $IRR;
        $USDIRR->counter_id = 6;
        $USDIRR->counter = $USD;
        $USDIRR->time = $time;
        $USDIRR->rate = Number::formString('0.000003125');

        $this->assertSame(1, $USDIRR->getID());
        $this->assertSame(5, $USDIRR->getBaseId());
        $this->assertSame($IRR, $USDIRR->getBase());
        $this->assertSame(6, $USDIRR->getCounterId());
        $this->assertSame($time, $USDIRR->getTime());
        $this->assertSame(3.13, $USDIRR->convert(1000000)->getValue());
        $this->assertSame('$ 3.13', $USDIRR->convertFormat(1000000));
    }
}
