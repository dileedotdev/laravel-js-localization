<?php

namespace Dinhdjj\JsLocalization\Tests;

use Dinhdjj\JsLocalization\JsLocalizationServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Dinhdjj\\JsLocalization\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            JsLocalizationServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');
        $app->useLangPath(__DIR__.'/lang');

        /*
        $migration = include __DIR__.'/../database/migrations/create_js-localization_table.php.stub';
        $migration->up();
        */
    }
}
