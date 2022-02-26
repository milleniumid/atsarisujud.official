<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Notification;
use Illuminate\Foundation\Testing\DatabaseTransactions;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
}
