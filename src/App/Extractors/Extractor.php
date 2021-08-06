<?php

namespace Asseco\BlueprintAudit\App\Extractors;

interface Extractor
{
    public function getId();

    public function getType(): string;
}
