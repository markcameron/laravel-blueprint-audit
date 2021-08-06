<?php

use Asseco\BlueprintAudit\App\Extractors\DefaultAuth;

return [

    /**
     * Define how will users be extracted to populate the fields.
     * Class must extend Extractor interface.
     */
    'extractor' => DefaultAuth::class,

];
