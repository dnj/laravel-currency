# Laravel Currency 💰

![Packagist Dependency Version](https://img.shields.io/packagist/dependency-v/dnj/dnj/laravel-currency)
![GitHub all releases](https://img.shields.io/github/downloads/dnj/laravel-currency/total)
![GitHub](https://img.shields.io/github/license/dnj/laravel-currency)
![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/dnj/laravel-currency/ci.yml)

## Introduction

The Currency Library provides a set of classes and interfaces to manage currencies and perform currency conversion. 
It is written in PHP and uses [dnj/php-number](https://github.com/dnj/php-number) to handle arbitrary precision calculations.

* Latest versions of PHP and PHPUnit and PHPCSFixer
* Best practices applied:
  * [`README.md`](https://github.com/dnj/laravel-currency/blob/master/README.md) (badges included)
  * [`LICENSE`](https://github.com/dnj/laravel-currency/blob/master/LICENSE)
  * [`composer.json`](https://github.com/dnj/laravel-currency/blob/master/composer.json)
  * [`phpunit.xml`](https://github.com/dnj/laravel-currency/blob/master/phpunit.xml)
  * [`.gitignore`](https://github.com/dnj/laravel-currency/blob/master/.gitignore)
  * [`.php-cs-fixer.php`](https://github.com/dnj/laravel-currency/blob/master/.php-cs-fixer.php)

## Installation

Require this package with [composer](https://getcomposer.org/).

```shell
composer require dnj/laravel-currency
```

Laravel uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

#### Copy the package config to your local config with the publish command:

```shell
php artisan vendor:publish --provider="dnj\Currency"
```

#### Config file

```php
<?php

return [
    'register_routes' => true, 
    'float_scale' => 10,
];
```
---
## Usage
### CurrencyManager
The `CurrencyManager` class allows you to create, retrieve, update, and delete currencies. Here's an example of how to use it:

```php
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\CurrencyManager;

$manager = new CurrencyManager();

// Create a currency
$currency = $manager->create('USD', 'US Dollar', '$', '', RoundingBehaviour::CEIL, 2);

// Retrieve a currency by its ID
$currency = $manager->get('USD');

// Update a currency
$currency->setName('United States Dollar');
$manager->update($currency);

// Delete a currency
$manager->delete('USD');

```

### ExchangeManager
The `ExchangeManager` class allows you to manage exchange rates and perform currency conversion. Here's an example of how to use it:
```php
use dnj\Currency\Contracts\RoundingBehaviour;
use dnj\Currency\CurrencyManager;
use dnj\Currency\ExchangeManager;

$currencyManager = new CurrencyManager();
$usd = $currencyManager->create('USD', 'US Dollar', '$', '', RoundingBehaviour::CEIL, 2);
$eur = $currencyManager->create('EUR', 'Euro', '€', '', RoundingBehaviour::CEIL, 2);

$exchangeManager = new ExchangeManager();
$exchangeManager->createRate($eur, $usd, 1.2);
$rate = $exchangeManager->getLastRate($eur, $usd);

$result = $exchangeManager->convert(100, $eur, $usd, false); // 120.0 USD
$formattedResult = $exchangeManager->convertFormat(100, $eur, $usd, false); // "$ 120.00"

```

### Models
The library provides the following models:
  * `Currency`: represents a currency. 
  * `ExchangeRate`: represents an exchange rate between two currencies.


### Rounding
The `RoundingBehaviour` class defines constants for different rounding behaviours:

* `RoundingBehaviour::CEIL`: rounds up.
* `RoundingBehaviour::FLOOR`: rounds down.
* `RoundingBehaviour::HALF_UP`: rounds up if the decimal is >= 0.5, otherwise rounds down.
* `RoundingBehaviour::HALF_DOWN`: rounds down if the decimal is < 0.5, otherwise rounds up.
* `RoundingBehaviour::HALF_EVEN`: rounds to the nearest even integer if the decimal is exactly 0.5, otherwise uses HALF_UP.
* `RoundingBehaviour::UP`: always rounds up.
* `RoundingBehaviour::DOWN`: always rounds down.
* `RoundingBehaviour::NONE`: no rounding.

---

## Testing

You can run unit tests with PHP Unit:

```php
./vendor/bin/phpunit
```


## Contribution

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any
contributions you make are greatly appreciated.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also
simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Security

If you discover any security-related issues, please email [security@dnj.co.ir](mailto:security@dnj.co.ir) instead of
using the issue tracker.

## License

The MIT License (MIT). Please
see [License File](https://github.com/dnj/laravel-currency/blob/master/LICENSE) for more information.
