<?php

namespace Asseco\BlueprintAudit\App\Traits;

use Asseco\BlueprintAudit\App\Extractors\Extractor;

trait Audit
{
    protected static function bootAudit()
    {
        [$id, $type] = self::extract();

        static::creating(function ($model) use ($id, $type) {
            $model->created_by = $id;
            $model->creator_type = $type;
            $model->updated_by = $id;
            $model->updater_type = $type;
        });

        static::updating(function ($model) use ($id, $type) {
            $model->updated_by = $id;
            $model->updater_type = $type;
        });
    }

    protected static function extract(): array
    {
        /** @var Extractor $extractor */
        $extractor = app(Extractor::class);

        return [
            $extractor->getId(),
            $extractor->getType()
        ];
    }
}
