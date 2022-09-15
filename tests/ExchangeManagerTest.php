<?php

namespace dnj\Currency\Tests;

use dnj\Currency\Contracts\ICurrencyManager;
use dnj\Currency\Contracts\IExchangeManager;
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\CurrencyManager;
use dnj\Currency\ExchangeManager;
use dnj\Currency\Models\Currency;
use dnj\Currency\Models\ExchangeRate;
use dnj\Number\Number;

class ExchangeManagerTest extends TestCase
{
    protected function getManager(): ExchangeManager
    {
        return $this->app->make(IExchangeManager::class);
    }

    protected function getCurrencyManager(): CurrencyManager
    {
        return $this->app->make(ICurrencyManager::class);
    }

    protected function createUSD(): Currency
    {
        return $this->getCurrencyManager()->create('USD', 'US Dollar', '$', '', RoundingBehaviour::CEIL, 2);
    }

    protected function createEUR(): Currency
    {
        return $this->getCurrencyManager()->create('EUR', 'Euro', '€', '', RoundingBehaviour::CEIL, 2);
    }

    protected function createRate($counter, $base): ExchangeRate
    {
        return $this->getManager()->createRate($counter, $base, Number::fromInput(rand(100, 200) / 100));
    }

    public function testCreate()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $this->assertTrue(true);
    }

    public function testDeleteRateByID()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $this->getManager()->deleteRate($rate->getID());
        $this->assertTrue(true);
    }

    public function testDeleteRateByModel()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $this->getManager()->deleteRate($rate);
        $this->assertTrue(true);
    }

    public function testGetLastRate()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $rateCopy = $this->getManager()->getLastRate($EUR, $USD);
        $this->assertSame($rate->getRate()->getValue(), $rateCopy->getRate()->getValue());
    }

    public function testGetRates()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rates = $this->getManager()->getRates($EUR, $USD);
        $this->assertSame(0, $rates->count());

        for ($x = 0; $x < 10; ++$x) {
            $this->createRate($EUR, $USD);
        }
        $rates = $this->getManager()->getRates($EUR, $USD);
        $this->assertSame(10, $rates->count());
    }

    public function testConvert()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $result = $this->getManager()->convert(2, $EUR, $USD, false);
        $this->assertSame($rate->getRate()->mul(2)->getValue(), $result->getValue());
    }

    public function testConvertFormat()
    {
        $USD = $this->createUSD();
        $EUR = $this->createEUR();
        $rate = $this->createRate($EUR, $USD);
        $result = $this->getManager()->convertFormat(2, $EUR, $USD, false);
        $this->assertSame('€ '.$rate->getRate()->mul(2)->getValue(), $result);
    }
}
