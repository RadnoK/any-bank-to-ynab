<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Parser\MBank;

use Money\Currency;
use Money\Money;
use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Parser\MBank\InflowParser;
use Tests\RadnoK\YNABTranslator\Mother\Model\MBankTransactionMother;

final class InflowParserTest extends TestCase
{
    /**
     * @dataProvider inflowValuesProvider
     */
    public function test_parsing_an_inflow_value(string $inputAmount, float $outputAmount): void
    {
        $parser = new InflowParser();

        $parsedInflow = $parser->parse(MBankTransactionMother::income($inputAmount));

        self::assertSame(
            (new Money($outputAmount, new Currency('PLN')))->getAmount(),
            $parsedInflow->getAmount()
        );
    }

    public function inflowValuesProvider(): array
    {
        return [
            ['8,48', 8.48],
            ['1000,00', 1000],
        ];
    }
}
