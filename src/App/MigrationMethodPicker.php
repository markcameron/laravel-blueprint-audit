<?php

namespace Asseco\BlueprintAudit\App;

use Illuminate\Database\Schema\Blueprint;

class MigrationMethodPicker
{
    public const SOFT = 'soft';
    public const PARTIAL = 'partial';
    public const FULL = 'full';

    public static function pick(Blueprint $table, string $migrationConfig = null)
    {
        switch ($migrationConfig) {
            case self::SOFT:
                $table->timestamps();
                $table->softDeletes();
                break;
            case self::PARTIAL:
                $table->audit();
                break;
            case self::FULL:
                $table->softDeleteAudit();
                break;
            default:
                $table->timestamps();
                break;
        }
    }
}
