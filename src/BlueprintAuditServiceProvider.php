<?php

declare(strict_types=1);

namespace Asseco\BlueprintAudit;

use Asseco\BlueprintAudit\App\Extractors\Extractor;
use Closure;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\ServiceProvider;

class BlueprintAuditServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/asseco-blueprint-audit.php', 'asseco-blueprint-audit');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/asseco-blueprint-audit.php' => config_path('asseco-blueprint-audit.php'),
        ], 'asseco-blueprint-audit');

        $this->app->bind(Extractor::class, config('asseco-blueprint-audit.extractor'));

        Blueprint::macro('audit', $this->audit());
        Blueprint::macro('softDeleteAudit', $this->softDeleteAudit());
    }

    protected function audit(): Closure
    {
        return function ($precision = 0) {
            /** @var $this Blueprint */
            $this->timestamp('created_at', $precision)->nullable(); // @phpstan-ignore-line
            $this->string('created_by')->nullable(); // @phpstan-ignore-line
            $this->string('creator_type')->nullable(); // @phpstan-ignore-line

            $this->timestamp('updated_at', $precision)->nullable(); // @phpstan-ignore-line
            $this->string('updated_by')->nullable(); // @phpstan-ignore-line
            $this->string('updater_type')->nullable(); // @phpstan-ignore-line
        };
    }

    protected function softDeleteAudit(): Closure
    {
        return function ($precision = 0) {
            /** @var $this Blueprint */
            $this->audit($precision); // @phpstan-ignore-line

            $this->timestamp('deleted_at', $precision)->nullable(); // @phpstan-ignore-line
            $this->string('deleted_by')->nullable(); // @phpstan-ignore-line
            $this->string('deleter_type')->nullable(); // @phpstan-ignore-line
        };
    }
}
