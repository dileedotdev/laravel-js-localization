# Give ability to uses laravel's `trans` function in js

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dinhdjj/js-localization.svg?style=flat-square)](https://packagist.org/packages/dinhdjj/js-localization)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/dinhdjj/js-localization/run-tests?label=tests)](https://github.com/dinhdjj/js-localization/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/dinhdjj/js-localization/Check%20&%20fix%20styling?label=code%20style)](https://github.com/dinhdjj/js-localization/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/dinhdjj/js-localization.svg?style=flat-square)](https://packagist.org/packages/dinhdjj/js-localization)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require dinhdjj/laravel-js-localization
```

## Usage

This package minify step to usage. You just add directive `@jslocalization` to blade layout.

```html
   <!-- resources/view/app.blade.com -->
<!DOCTYPE html>
<html>
    <head>

        @jslocalization

        <!-- other js -->
    </head>
    <body class="font-sans antialiased">
        <!--  -->
    </body>
</html>
```

And you must remember that when you update this package or update lang files. You should run below command to make it effect

```bash
    php artisan view:cache
```

If you use typescript below lines will help you

```ts
type Trans = (key: string, replaces?: Record<string,string>, local?: string|null) => string;
type TransChoice = (key: string, number: number, replaces?: Record<string,string>, local?: string|null) => string;

declare global {
    interface Window {
        __: Trans;
        trans: Trans;
        transChoice: TransChoice;
    }
}
```

Finally usage in real life

```js
    window.trans('hello :name', {name: 'dinhdjj'});
    window.__('hello :name', {name: 'dinhdjj'});
    window.transChoice('hello :name|xin chao :name', 1,{name: 'dinhdjj'});
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [dinhdjj](https://github.com/dinhdjj)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
