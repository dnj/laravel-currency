# Management user account and transaction inside laravel app

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]][link-license]
[![Testing status][ico-workflow-test]][link-workflow-test]
[![Open API][ico-open-api]][link-open-api]

## Introduction

The dnj/laravel-currency Public package provides easy way to manage  currency and exchange of your app. The Package stores all data in the accounts and transactions table.
* Latest versions of PHP and PHPUnit and PHPCsFixer
* Best practices applied:
    * [`README.md`][link-readme] (badges included)
    * [`LICENSE`][link-license]
    * [`composer.json`][link-composer-json]
    * [`phpunit.xml`][link-phpunit]
    * [`.gitignore`][link-gitignore]
    * [`.php-cs-fixer.php`][link-phpcsfixer]
    * [`openAPI`][link-phpcsfixer]
* Some useful resources to start coding

## Installation
You can install the package via composer:
```bash
composer require dnj/laravel-currency
```

The package will automatically register itself.


After this you can create the `currencies and exchange_rates` table by running the migrations:

```bash
php artisan migrate
```

You can optionally publish the config file with:

```bash
php artisan vendor:publish --provider="dnj\laravel-currency\CurrencyServiceProvider" --tag="config"
```

## How to use package API

A document in YAML format has been prepared for better familiarization and use of package web services. which is placed in the [`docs`][link-docs] folder.

To use this file, you can import it on the [stoplight.io](https://stoplight.io) site and see all available web services.


## Contribution

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement". Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## Testing
```bash
./vendor/bin/phpunit 
```
## About
We'll try to maintain this project as simple as possible, but Pull Requests are welcomed!

## License

The MIT License (MIT). Please see [License File][link-license] for more information.

[ico-version]: https://img.shields.io/packagist/v/dnj/laravel-currency.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dnj/laravel-currency.svg?style=flat-square
[ico-workflow-test]: https://github.com/dnj/laravel-currency/actions/workflows/test.yaml/badge.svg
[ico-open-api]: https://img.shields.io/endpoint?color=blue&label=openAPI&logo=%22%236BA539%22&logoColor=blue&style=for-the-badge&url=https%3A%2F%2Fimg.shields.io%2Fendpoint%3Furl%3Dhttps%3A%2F%2Fgithub.com%2Fdnj%2Flaravel-account%2Fblob%2Fmaster%2FapiDocs%2Faccount.json

[link-open-api]: https://github.com/dnj/laravel-currency/blob/master/apiDocs/account.json
[link-workflow-test]: https://github.com/dnj/laravel-currency/actions/workflows/test.yaml
[link-packagist]: https://packagist.org/packages/dnj/laravel-currency
[link-license]: https://github.com/dnj/laravel-currency/blob/master/LICENSE
[link-downloads]: https://packagist.org/packages/dnj/laravel-currency
[link-readme]: https://github.com/dnj/laravel-currency/blob/master/README.md
[link-composer-json]: https://github.com/dnj/laravel-currency/blob/master/composer.json
[link-phpunit]: https://github.com/dnj/laravel-currency/blob/master/phpunit.xml
[link-gitignore]: https://github.com/dnj/laravel-currency/blob/master/.gitignore
[link-phpcsfixer]: https://github.com/dnj/laravel-currency/blob/master/.php-cs-fixer.php
[link-author]: https://github.com/dnj
