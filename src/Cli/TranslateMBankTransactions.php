<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Cli;

use RadnoK\YNABTranslator\Processor\ProcessorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class TranslateMBankTransactions extends Command
{
    public const COMMAND_NAME = 'radnok:ynab-translator:mbank';

    /** @var ProcessorInterface */
    private $mBankProcessor;

    /** @var SymfonyStyle */
    private $io;

    public function __construct(ProcessorInterface $mBankProcessor)
    {
        parent::__construct(self::COMMAND_NAME);

        $this->mBankProcessor = $mBankProcessor;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('This is mBank transactions translator for YNAB. It parses transactions from bank .csv to one accepted and understood by YNAB.')
            ->addArgument('source-file', InputArgument::REQUIRED,  'mBank .csv file path with transactions.')
        ;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io->title('mBank Transactions Translator for YNAB');

        try {
            $this->mBankProcessor->process($input->getArgument('source-file'));

            $this->io->success('Successfully parsed mBank transactions!');
        } catch (\Exception $exception) {
            $this->io->error(sprintf('Something went wrong. [%s]', $exception->getMessage()));

            return 1;
        }

        return 0;
    }
}
