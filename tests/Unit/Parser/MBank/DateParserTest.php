<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Parser\MBank;

use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Parser\MBank\DateParser;
use Tests\RadnoK\YNABTranslator\Mother\Model\MBankTransactionMother;

final class DateParserTest extends TestCase
{
    public function test_parsing_title_to_transaction_date(): void
    {
        $parser = new DateParser();

        $parsedDate = $parser->parse(MBankTransactionMother::datedOutcome(
            new \DateTime('yesterday'),
            new \DateTime('2 days ago')
        ));

        self::assertSame(
            (new \DateTime('2 days ago'))->format('Y-m-d'),
            $parsedDate->format('Y-m-d')
        );
    }

    public function test_parsing_transaction_date(): void
    {
        $parser = new DateParser();

        $parsedDate = $parser->parse(MBankTransactionMother::datedIncome(new \DateTime('yesterday')));

        self::assertSame(
            (new \DateTime('yesterday'))->format('Y-m-d'),
            $parsedDate->format('Y-m-d')
        );
    }
}
