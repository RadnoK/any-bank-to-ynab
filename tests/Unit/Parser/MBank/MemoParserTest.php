<?php

declare(strict_types=1);

namespace Tests\RadnoK\YNABTranslator\Unit\Parser\MBank;

use PHPUnit\Framework\TestCase;
use RadnoK\YNABTranslator\Parser\MBank\MemoParser;
use Tests\RadnoK\YNABTranslator\Mother\Model\MBankTransactionMother;

final class MemoParserTest extends TestCase
{
    /**
     * @dataProvider
     */
    public function test_parsing_valid_string() : void
    {
        $parser = new MemoParser();

        $result = $parser->parse(MBankTransactionMother::titled('ZABKA    /LODZ                                              DATA TRANSAKCJI: 2019-01-31'));

        self::assertEquals('Zabka    ', $result);
    }

    public function memoValuesProvider() : array
    {
        return [
            [
                'ZABKA    /LODZ                                              DATA TRANSAKCJI: 2019-01-31',
                'Zabka    ',
            ],
            [
                'PRZELEW ŚRODKÓW',
                'Przelew środków',
            ],
        ];
    }
}
