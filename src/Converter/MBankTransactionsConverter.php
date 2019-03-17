<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Converter;

use RadnoK\YNABTranslator\Model\MBank;
use RadnoK\YNABTranslator\Model\YNAB;
use RadnoK\YNABTranslator\Parser;

final class MBankTransactionsConverter implements TransactionsConverter
{
    /** @var Parser\MBank\DateParserInterface */
    private $dateParser;

    /** @var Parser\MBank\MemoParserInterface */
    private $memoParser;

    /** @var Parser\MBank\InflowParserInterface */
    private $inflowParser;

    /** @var Parser\MBank\OutflowParserInterface */
    private $outflowParser;

    public function __construct(
        Parser\MBank\DateParserInterface $dateParser,
        Parser\MBank\MemoParserInterface $memoParser,
        Parser\MBank\InflowParserInterface $inflowParser,
        Parser\MBank\OutflowParserInterface $outflowParser
    ) {
        $this->dateParser    = $dateParser;
        $this->memoParser    = $memoParser;
        $this->inflowParser  = $inflowParser;
        $this->outflowParser = $outflowParser;
    }

    public function convert(iterable $originalTransactions) : YNAB\Transactions
    {
        return new YNAB\Transactions(...$this->parseOriginalTransactions($originalTransactions));
    }

    private function parseOriginalTransactions(iterable $originalTransactions) : iterable
    {
        foreach ($originalTransactions as $transaction) {
            $mBankTransaction = MBank\Transaction::fromArray($transaction);

            yield new YNAB\Transaction(
                $this->dateParser->parse($mBankTransaction),
                null,
                $this->memoParser->parse($mBankTransaction),
                $this->inflowParser->parse($mBankTransaction),
                $this->outflowParser->parse($mBankTransaction)
            );
        }
    }
}
