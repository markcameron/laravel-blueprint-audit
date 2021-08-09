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
            /**
             * @var $this Blueprint
             */
            $this->timestamp('created_at', $precision)->nullable();
            $this->string('created_by')->nullable();
            $this->string('creator_type')->nullable();

            $this->timestamp('updated_at', $precision)->nullable();
            $this->string('updated_by')->nullable();
            $this->string('updater_type')->nullable();
        };
    }

    protected function softDeleteAudit(): Closure
    {
        return function ($precision = 0) {
            /**
             * @var $this Blueprint
             */
            $this->audit($precision);

            $this->timestamp('deleted_at', $precision)->nullable();
            $this->string('deleted_by')->nullable();
            $this->string('deleter_type')->nullable();
        };
    }
}
