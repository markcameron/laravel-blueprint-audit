<?php

namespace Asseco\BlueprintAudit\App\Traits;

use Asseco\BlueprintAudit\App\Extractors\Extractor;

trait Audit
{
    protected static function bootAudit()
    {
        static::creating(function ($model) {
            [$id, $type] = self::extract();

            $model->created_by = $id;
            $model->creator_type = $type;
            $model->updated_by = $id;
            $model->updater_type = $type;
        });

        static::updating(function ($model) {
            [$id, $type] = self::extract();

            $model->updated_by = $id;
            $model->updater_type = $type;
        });
    }

    protected static function extract(): array
    {
        // Can't bind here because trait boots before binding happens
        /** @var Extractor $extractor */
        $extractorClass = config('asseco-blueprint-audit.extractor');
        $extractor = new $extractorClass;

        return [
            $extractor->getId(),
            $extractor->getType(),
        ];
    }
}
