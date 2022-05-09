<?php

namespace Dinhdjj\JsLocalization;

use Dinhdjj\JsLocalization\Facades\JsLocalization;
use Dinhdjj\JsLocalization\JsLocalization as MainJsLocalization;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            // ->hasConfigFile()
            // ->hasViews()
            // ->hasMigration('create_js-localization_table')
            // ->hasCommand(JsLocalizationCommand::class)
        ;
    }

    public function packageRegistered(): void
    {
        $this->app->bind('js-localization', fn () => new MainJsLocalization());
    }

    public function packageBooted(): void
    {
        Blade::directive('jslocalization', function () {
            $langs = json_encode(JsLocalization::getLangs());
            $mainJs = file_get_contents(__DIR__.'/../dist/main.js');

            return '<script type="text/javascript">'
                ."window._jsLocalization={locale:'<?php echo app()->getLocale() ?>',langs:{$langs},}"
                .$mainJs
                .'</script>'
            ;
        });
    }
}
