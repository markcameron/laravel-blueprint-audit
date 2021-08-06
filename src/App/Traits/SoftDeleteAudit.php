<?php

namespace Asseco\BlueprintAudit\App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait SoftDeleteAudit
{
    use SoftDeletes, Audit;

    protected static function bootSoftDeleteAudit()
    {
        [$id, $type] = self::extract();

        static::deleting(function ($model) use ($id, $type) {
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
