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


    public function testCreate()
    {
        $USD = $this->getManager()->create('USD', 'US Dollar', '$', '', RoundingBehaviour::CEIL, 2);
        $this->assertInstanceOf(Currency::class, $USD);
    }

    public function testFirstByCode()
    {
        $USD = Currency::factory()->asUSD()->create();
        $USDCopy = $this->getManager()->firstByCode('USD');
        $this->assertSame($USD->getID(), $USDCopy->getID());
    }

    public function testFindByCode()
    {
        $this->assertSame(0, $this->getManager()->findByCode('USD')->count());
        $USD = Currency::factory()->asUSD()->create();
        $this->assertSame(1, $this->getManager()->findByCode('USD')->count());
        $USD2 = Currency::factory()->asUSD()->withTitle('US Dollar From other source')->create();
        $this->assertSame(2, $this->getManager()->findByCode('USD')->count());
    }

    public function testDelete()
    {
        $USD = Currency::factory()->asUSD()->create();
        $this->getManager()->delete($USD->getID());
        $this->assertSame(0, $this->getManager()->findByCode('USD')->count());
    }

    public function testGetByID()
    {
        $USD = Currency::factory()->asUSD()->create();
        $USDCopy = $this->getManager()->getByID($USD->getID());
        $this->assertSame($USD->getCode(), $USDCopy->getCode());
    }

    public function testGetAll()
    {
        Currency::factory()->asUSD()->create();
        $all = $this->getManager()->getAll();
        $this->assertSame(1, $all->count());
    }
}
