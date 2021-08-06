<?php

namespace Illuminate\Database\Schema {

    class Blueprint
    {
        public function audit($precision = 0): \Closure
        {
            /** @var \Asseco\Chassis\Initializers\BlueprintAudit $instance */
            return $instance->handle();
        }

        public function softDeleteAudit($precision = 0): \Closure
        {
            /** @var \Asseco\Chassis\Initializers\BlueprintAudit $instance */
            return $instance->handle();
        }
    }
}
