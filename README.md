# spryker-newsletter

[![Build Status](https://travis-ci.org/fond-of/spryker-product-api.svg?branch=master)](https://travis-ci.org/fond-of/newsletter)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/newsletter)

## Installation

```
composer require fond-of-spryker/newsletter
```

## Configuration

Register NewsletterControllerProviderPlugin in RouterDependencyProvider

```
    protected function getRouteProvider(): array
    {
        return [
            ...
            new NewsletterControllerProviderPlugin(),
        ];
    }
```

Register NewsletterFooterFormWidget in ShopApplicationDependencyProvider

```
    protected function getGlobalWidgets(): array
    {
        return [
            ...
            NewsletterFooterFormWidget::class,
        ];
    }
```

## Usage
Use in templates
```
{% widget 'NewsletterFooterFormWidget' only %}{% endwidget %}
```
instead of the {{ render(path('XXX')) }}

## Changelog
2020-03-31
 * added support for new routing in spryker
 * added widget for the form
