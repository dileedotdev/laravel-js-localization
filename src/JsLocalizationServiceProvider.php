<?php

namespace Dinhdjj\JsLocalization;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Dinhdjj\JsLocalization\Commands\JsLocalizationCommand;

class JsLocalizationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('js-localization')
            ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_js-localization_table')
            ->hasCommand(JsLocalizationCommand::class);
    }
}
