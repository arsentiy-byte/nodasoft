<?php

declare(strict_types=1);

namespace Tests;

use Core\Traits\ConfigTrait;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use ConfigTrait, CreatesApplication, WithFaker;
}
