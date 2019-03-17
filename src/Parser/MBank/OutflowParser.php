<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use Money\Currency;
use Money\Money;
use RadnoK\YNABTranslator\Model\MBank;
use function abs;

final class OutflowParser implements OutflowParserInterface
{
    public function parse(MBank\Transaction $transaction) : ?Money
    {
        $amount = $transaction->amount();

        if ($amount >= 0) {
            return null;
        }

        return new Money(abs($amount), new Currency('PLN'));
    }
}
