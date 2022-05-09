<?php

use Dinhdjj\JsLocalization\Facades\JsLocalization;

test('its getExistingLocales work', function (): void {
    $locales = JsLocalization::getExistingLocales();

    expect($locales)->toBeArray();
    expect($locales)->toHaveCount(2);
    expect($locales)->toContain('en');
    expect($locales)->toContain('vi');
});

test('its getLang work', function (): void {
    $lang = JsLocalization::getLang('vi');

    expect($lang)->toBeArray();
    expect($lang)->toHaveCount(2);
    expect($lang['auth.failed'])->toBe(trans('auth.failed', locale: 'vi'));
    expect($lang['say-hello'])->toBe(trans('say-hello', locale: 'vi'));
});

test('its getLangs work', function (): void {
    $langs = JsLocalization::getLangs();

    expect($langs)->toBeArray();
    expect($langs)->toHaveCount(2);
    expect($langs)->toHaveKeys(['vi', 'en']);
    expect($langs['vi']['auth.failed'])->toBe(trans('auth.failed', locale: 'vi'));
    expect($langs['vi']['say-hello'])->toBe(trans('say-hello', locale: 'vi'));
    expect($langs['en']['say-hello'])->toBe(trans('say-hello', locale: 'en'));
});
