<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use Money\Currency;
use Money\Money;
use RadnoK\YNABTranslator\Model\MBank;

final class InflowParser implements InflowParserInterface
{
    public function parse(MBank\Transaction $transaction) : ?Money
    {
        $amount = $transaction->amount();

        if ($amount <= 0) {
            return null;
        }

        return new Money($amount, new Currency('PLN'));
    }
}
