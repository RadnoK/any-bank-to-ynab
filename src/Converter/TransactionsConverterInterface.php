<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Converter;

use RadnoK\YNABTranslator\Model\YNAB;

interface TransactionsConverterInterface
{
    public function convert(iterable $originalTransactions): YNAB\Transactions;
}
