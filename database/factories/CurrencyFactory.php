<?php

namespace dnj\Currency\Database\Factories;

use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Currency>
 */
class CurrencyFactory extends Factory
{
    protected $model = Currency::class;

    public function definition()
    {
        return [
            'code' => fake()->currencyCode(),
            'title' => fake()->word(),
            'prefix' => '',
            'suffix' => '',
            'rounding_behaviour' => fake()->randomElement([RoundingBehaviour::CEIL, RoundingBehaviour::ROUND, RoundingBehaviour::FLOOR]),
            'rounding_precision' => fake()->numberBetween(-2, 2),
        ];
    }

    public function withCode(string $code)
    {
        return $this->state(fn () => [
            'code' => $code,
        ]);
    }

    public function withTitle(string $title)
    {
        return $this->state(fn () => [
            'title' => $title,
        ]);
    }

    public function withPrefix(string $prefix)
    {
        return $this->state(fn () => [
            'prefix' => $prefix,
        ]);
    }

    public function withSuffix(string $suffix)
    {
        return $this->state(fn () => [
            'suffix' => $suffix,
        ]);
    }

    public function withCeilingBehaviour()
    {
        return $this->state(fn () => [
            'rounding_behaviour' => RoundingBehaviour::CEIL,
        ]);
    }

    public function withFlooringBehaviour()
    {
        return $this->state(fn () => [
            'rounding_behaviour' => RoundingBehaviour::FLOOR,
        ]);
    }

    public function withRoundingBehaviour(RoundingBehaviour $behaviour = RoundingBehaviour::ROUND)
    {
        return $this->state(fn () => [
            'rounding_behaviour' => $behaviour,
        ]);
    }

    public function withPrecision(int $precision)
    {
        return $this->state(fn () => [
            'rounding_precision' => $precision,
        ]);
    }

    public function asUSD()
    {
        return $this->state(fn () => [
            'code' => 'USD',
            'title' => 'US Dollar',
            'prefix' => '$',
            'suffix' => '',
            'rounding_precision' => 2,
        ]);
    }

    public function asEUR()
    {
        return $this->state(fn () => [
            'code' => 'EUR',
            'title' => 'Euro',
            'prefix' => '€',
            'suffix' => '',
            'rounding_precision' => 2,
        ]);
    }
}
