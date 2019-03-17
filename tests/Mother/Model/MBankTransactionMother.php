<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Mother\Model;

use RadnoK\YNABTranslator\Model\MBank\Transaction;

final class MBankTransactionMother
{
    public static function titled(string $title): Transaction
    {
        return Transaction::fromArray([
            '2019-01-31',
            '2019-01-31',
            'ZAKUP PRZY UŻYCIU KARTY',
            $title,
            '',
            '',
            '-8,48',
            '1,52',
            '',
        ]);
    }

    public static function outcome(string $amount): Transaction
    {
        return Transaction::fromArray([
            '2019-01-31',
            '2019-01-31',
            'ZAKUP PRZY UŻYCIU KARTY',
            'ZABKA    /LODZ                                              DATA TRANSAKCJI: 2019-01-31',
            '',
            '',
            $amount,
            '1,52',
            '',
        ]);
    }

    public static function income(string $amount): Transaction
    {
        return Transaction::fromArray([
            '2019-01-31',
            '2019-01-31',
            'PRZELEW ZEWNĘTRZNY PRZYCHODZĄCY',
            'PRZELEW',
            'TESTER TESTOWY',
            '12341234123412341234123412',
            $amount,
            '18,48',
            '',
        ]);
    }

    public static function datedIncome(\DateTimeInterface $operationDate): Transaction
    {
        return Transaction::fromArray([
            $operationDate->format('Y-m-d'),
            $operationDate->format('Y-m-d'),
            'ZAKUP PRZY UŻYCIU KARTY',
            sprintf('ZABKA    /LODZ                                              DATA TRANSAKCJI: %s', $operationDate->format('Y-m-d')),
            '',
            '',
            '-8,48',
            '1,52',
            '',
        ]);
    }

    public static function datedOutcome(
        \DateTimeInterface $operationDate,
        \DateTimeInterface $transactionDate
    ): Transaction {
        return Transaction::fromArray([
            $operationDate->format('Y-m-d'),
            $operationDate->format('Y-m-d'),
            'ZAKUP PRZY UŻYCIU KARTY',
            sprintf('ZABKA    /LODZ                                              DATA TRANSAKCJI: %s', $transactionDate->format('Y-m-d')),
            '',
            '',
            '-8,48',
            '1,52',
            '',
        ]);
    }
}
