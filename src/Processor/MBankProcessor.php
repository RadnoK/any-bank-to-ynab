<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Processor;

use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\Writer;
use RadnoK\YNABTranslator\Converter\TransactionsConverter;
use function sprintf;
use function time;

final class MBankProcessor implements Processor
{
    private const DELIMITER = ';';

    /**
     * First 32 rows are just a bunch of summaries
     */
    private const START_OFFSET = 32;

    /**
     * Last rows are just totals
     */
    private const LIMIT_OFFSET = 3;

    /** @var TransactionsConverter */
    private $transactionsConverter;

    /** @var string */
    private $projectDirectory;

    /** @var string */
    private $outputDirectory;

    public function __construct(
        TransactionsConverter $transactionsConverter,
        string $projectDirectory,
        string $outputDirectory
    ) {
        $this->transactionsConverter = $transactionsConverter;
        $this->projectDirectory      = $projectDirectory;
        $this->outputDirectory       = $outputDirectory;
    }

    public function process(string $sourceFilePath) : void
    {
        $inputCsvFile = Reader::createFromPath($sourceFilePath);
        $inputCsvFile->setDelimiter(self::DELIMITER);

        $statement = (new Statement())
            ->offset(self::START_OFFSET)
            ->limit($inputCsvFile->count() - self::START_OFFSET - self::LIMIT_OFFSET);

        $originalTransactions = $statement->process($inputCsvFile);

        $transactions = $this->transactionsConverter->convert($originalTransactions);

        $outputCsvFile = Writer::createFromPath($this->outputFileName(), 'w+');
        $outputCsvFile->insertOne(['Date', 'Payee', 'Memo', 'Inflow', 'Outflow']);
        $outputCsvFile->insertAll($transactions->all());
    }

    private function outputFileName() : string
    {
        return sprintf('%s/%s/%s.csv', $this->projectDirectory, $this->outputDirectory, time());
    }
}
