<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Unit\Parser\MBank;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Parser\MBank\OutflowParser;
use Tests\RadnoK\YNABTranslator\Mother\Model\MBankTransactionMother;

final class OutflowParserTest extends TestCase
{
    public function test_parsing_an_outflow_value() : void
    {
        $parser = new OutflowParser();

        $parsedInflow = $parser->parse(MBankTransactionMother::outcome('-8,48'));

        self::assertSame(
            (new Money(8.48, new Currency('PLN')))->getAmount(),
            $parsedInflow->getAmount()
        );
    }
}
