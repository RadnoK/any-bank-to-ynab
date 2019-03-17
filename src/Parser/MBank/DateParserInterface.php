<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use DateTimeInterface;
use RadnoK\YNABTranslator\Model\MBank;

interface DateParserInterface
{
    public function parse(MBank\Transaction $transaction) : DateTimeInterface;
}
