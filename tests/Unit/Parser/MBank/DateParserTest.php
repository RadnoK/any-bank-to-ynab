<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Unit\Parser\MBank;

use DateTime;
use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Parser\MBank\DateParser;
use Tests\RadnoK\YNABTranslator\Mother\Model\MBankTransactionMother;

final class DateParserTest extends TestCase
{
    public function testParsingTitleToTransactionDate() : void
    {
        $parser = new DateParser();

        $parsedDate = $parser->parse(MBankTransactionMother::datedOutcome(
            new DateTime('yesterday'),
            new DateTime('2 days ago')
        ));

        self::assertSame(
            (new DateTime('2 days ago'))->format('Y-m-d'),
            $parsedDate->format('Y-m-d')
        );
    }

    public function testParsingTransactionOperationDate() : void
    {
        $parser = new DateParser();

        $parsedDate = $parser->parse(MBankTransactionMother::datedIncome(new DateTime('yesterday')));

        self::assertSame(
            (new DateTime('yesterday'))->format('Y-m-d'),
            $parsedDate->format('Y-m-d')
        );
    }
}
