<?php

namespace Dinhdjj\JsLocalization\Commands;

use Illuminate\Console\Command;

class JsLocalizationCommand extends Command
{
    public $signature = 'js-localization';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
