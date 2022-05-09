<?php

namespace Dinhdjj\JsLocalization;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class JsLocalization
{
    /**
     * Get all lang contents.
     *
     * @return array<string,array<string,string>>
     */
    public function getLangs(): array
    {
        $locales = $this->getExistingLocales();

        $langs = [];

        foreach ($locales as $locale) {
            $langs[$locale] = $this->getLang($locale);
        }

        return $langs;
    }

    /**
     * Load all content of all files in given locale.
     *
     * @return array<string,string>
     */
    public function getLang(string $locale): array
    {
        $phpTranslations = [];
        $jsonTranslations = [];

        if (File::exists(lang_path($locale))) {
            $phpTranslations = collect(File::allFiles(lang_path($locale)))
                ->filter(fn ($file) => 'php' === $file->getExtension())
                ->flatMap(fn ($file) => Arr::dot([
                    basename($file->getRealPath(), '.php') => File::getRequire($file->getRealPath()),
                ]))
                ->toArray()
            ;
        }

        if (File::exists(lang_path($locale.'.json'))) {
            $jsonTranslations = json_decode(File::get(lang_path($locale.'.json')), true);
        }

        return array_merge($phpTranslations, $jsonTranslations);
    }

    /**
     * Get all locales has language files.
     *
     * @return string[]
     */
    public function getExistingLocales(): array
    {
        $phpLocales = collect(File::directories(lang_path()))
            ->map(fn ($locale) => basename($locale))
            ->toArray()
        ;

        $jsonLocales = collect(File::files(lang_path()))
            ->map(fn ($file) => basename($file->getRealPath(), '.json'))
            ->toArray()
        ;

        return collect(array_merge($phpLocales, $jsonLocales))
            ->filter(fn ($locale) => 'vendor' !== $locale)
            ->unique()
            ->toArray()
        ;
    }
}
