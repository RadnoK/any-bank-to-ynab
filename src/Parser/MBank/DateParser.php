<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use DateTime;
use DateTimeInterface;
use RadnoK\YNABTranslator\Model\MBank;
use function preg_match;
use function str_replace;

final class DateParser implements DateParserInterface
{
    public function parse(MBank\Transaction $transaction) : DateTimeInterface
    {
        preg_match('/DATA TRANSAKCJI: ([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/', $transaction->title(), $matches);

        if (empty($matches)) {
            return $transaction->operationDate();
        }

        return new DateTime(str_replace('DATA TRANSAKCJI: ', '', $matches[0]));
    }
}
