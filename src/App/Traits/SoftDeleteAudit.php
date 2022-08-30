<?php

namespace Asseco\BlueprintAudit\App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeleteAudit
{
    use SoftDeletes, Audit;

    protected static function bootSoftDeleteAudit()
    {
        static::deleting(function ($model) {
            [$id, $type] = self::extract();

            $model->deleted_by = $id;
            $model->deleter_type = $type;
            $model->saveQuietly();
        });

        static::restoring(function ($model) {
            $model->deleted_by = null;
            $model->deleter_type = null;
        });
    }
}
