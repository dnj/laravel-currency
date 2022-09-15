<?php

namespace dnj\Currency\Tests;

use dnj\Currency\Contracts\ICurrencyManager;
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\CurrencyManager;
use dnj\Currency\Models\Currency;

class CurrencyManagerTest extends TestCase
{
    protected function getManager(): CurrencyManager
    {
        return $this->app->make(ICurrencyManager::class);
    }

    protected function createUSD(): Currency
    {
        return $this->getManager()->create('USD', 'US Dollar', '$', '', RoundingBehaviour::CEIL, 2);
    }

    public function testCreate()
    {
        $USD = $this->createUSD();
        $this->assertInstanceOf(Currency::class, $USD);
    }

    public function testFirstByCode()
    {
        $USD = $this->createUSD();
        $USDCopy = $this->getManager()->firstByCode('USD');
        $this->assertSame($USD->getID(), $USDCopy->getID());
    }

    public function testFindByCode()
    {
        $this->assertSame(0, $this->getManager()->findByCode('USD')->count());
        $USD = $this->createUSD();
        $this->assertSame(1, $this->getManager()->findByCode('USD')->count());
        $USD2 = $this->getManager()->create('USD', 'US Dollar From other source', '$', '', RoundingBehaviour::CEIL, 2);
        $this->assertSame(2, $this->getManager()->findByCode('USD')->count());
    }

    public function testDelete()
    {
        $USD = $this->createUSD();
        $this->getManager()->delete($USD->getID());
        $this->assertSame(0, $this->getManager()->findByCode('USD')->count());
    }

    public function testGetByID()
    {
        $USD = $this->createUSD();
        $USDCopy = $this->getManager()->getByID($USD->getID());
        $this->assertSame($USD->getCode(), $USDCopy->getCode());
    }

    public function testGetAll()
    {
        $USD = $this->createUSD();
        $all = $this->getManager()->getAll();
        $this->assertSame(1, $all->count());
    }
}
