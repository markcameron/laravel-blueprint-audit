<?php

declare(strict_types=1);

namespace Asseco\Attachments\Tests;

use Asseco\BlueprintAudit\BlueprintAuditServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [BlueprintAuditServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
