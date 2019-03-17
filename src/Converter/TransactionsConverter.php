<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Converter;

use RadnoK\YNABTranslator\Model\YNAB;

interface TransactionsConverter
{
    public function convert(iterable $originalTransactions) : YNAB\Transactions;
}
