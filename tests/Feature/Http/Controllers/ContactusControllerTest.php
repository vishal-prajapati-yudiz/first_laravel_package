<?php

namespace Spatie\Skeleton\Tests\Feature\Http\Controllers;

use Spatie\Skeleton\Tests\TestCase;

/**
 *
 */
class ContactusControllerTest extends TestCase
{
    /** @test */
    public function the_contactus_controllers()
    {
        $this->get('/my-package-routes')->assertOk()->assertSee('hello from view');
    }
}
