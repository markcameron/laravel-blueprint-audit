<?php

namespace Asseco\BlueprintAudit\App;

use Exception;
use Illuminate\Database\Schema\Blueprint;

class MigrationMethodPicker
{
    public const PLAIN = 'plain';
    public const SOFT = 'soft';
    public const PARTIAL = 'partial';
    public const FULL = 'full';

    public static function pick(Blueprint $table, string $migrationConfig = null)
    {
        switch ($migrationConfig) {
            case self::PLAIN:
                $table->timestamps();
                break;
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
                throw new Exception("No such picker defined.");
        }
    }
}
