<?php

namespace Spatie\Skeleton\Commands;

use Illuminate\Console\Command;

class SkeletonCommand extends Command
{
    public $signature = 'skeleton';

    public $description = 'My command';

    public function handle()
    {
        $outputText = config('skeleton.command_output_text');

        $this->comment($outputText);
    }
}
