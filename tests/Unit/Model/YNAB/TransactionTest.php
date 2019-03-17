<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Unit\Model\YNAB;

use DateTime;
use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Model\YNAB\Transaction;

final class TransactionTest extends TestCase
{
    public function testCreatingInflowTransaction() : void
    {
        $transaction = new Transaction(
            $date    = new DateTime('now'),
            $payee   = null,
            $memo    = 'super transaction!',
            $inflow  = new Money(10, new Currency('PLN')),
            $outflow = null
        );

        self::assertEquals($date->format('Ymd'), $transaction->date()->format('Ymd'));
        self::assertNull($transaction->payee());
        self::assertEquals($memo, $transaction->memo());
        self::assertEquals((float) $inflow->getAmount(), $transaction->inflowAmount());
        self::assertNull($transaction->outflowAmount());
    }
}
