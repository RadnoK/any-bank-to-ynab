<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use RadnoK\YNABTranslator\Model\MBank;

interface MemoParserInterface
{
    public function parse(MBank\Transaction $transaction) : string;
}
