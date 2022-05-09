<?php

use Illuminate\Support\Facades\Blade;

it('has jslocalization blade directive', function (): void {
    expect(Blade::getCustomDirectives())->toHaveKey('jslocalization');
});
