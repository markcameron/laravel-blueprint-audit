<?php

namespace Asseco\BlueprintAudit\App\Extractors;

class DefaultAuth implements Extractor
{
    public function getId()
    {
        return auth()->id();
    }

    public function getType(): string
    {
        return 'user';
    }
}
