<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Processor;

interface Processor
{
    public function process(string $sourceFilePath) : void;
}
