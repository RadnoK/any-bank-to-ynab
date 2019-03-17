<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use Money\Money;
use RadnoK\YNABTranslator\Model\MBank;

interface OutflowParserInterface
{
    public function parse(MBank\Transaction $transaction): ?Money;
}
