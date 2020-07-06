<?php

namespace Spatie\Skeleton\Tests\Feature\Commands;

use Spatie\Skeleton\Tests\TestCase;

class SkeletonCommandTest extends TestCase
{
    /** @test */
    public function the_skeleton_commnd_works()
    {
        $this->artisan('skeleton')->assertExitCode(0);
    }

    /** @test */
    public function the_config_file_value_is_used_as_output()
    {
        $this->artisan('skeleton')
             ->expectsOutput('Hi from command')
             ->assertExitCode(0);
    
        $text = "customized text";
        config()->set('skeleton.command_output_text', $text);
    

        $this->artisan('skeleton')
             ->expectsOutput($text)
             ->assertExitCode(0);
    }
}
