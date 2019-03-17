<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Model\MBank;

use Assert\Assertion;
use DateTime;
use DateTimeInterface;
use function chr;
use function str_replace;

final class Transaction
{
    private const TOTAL_COLUMNS = 9;

    /** @var string */
    private $operationDate;

    /** @var string */
    private $postingDate;

    /** @var string */
    private $description;

    /** @var string */
    private $title;

    /** @var string */
    private $payee;

    /** @var string */
    private $accountNumber;

    /** @var string */
    private $amount;

    /** @var string */
    private $total;

    private function __construct(
        string $operationDate,
        string $postingDate,
        string $description,
        string $title,
        string $payee,
        string $accountNumber,
        string $amount,
        string $total
    ) {
        Assertion::regex($operationDate, '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/');
        Assertion::regex($postingDate, '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/');
        Assertion::regex($amount, '/\-?[0-9 ]+,[0-9]+/');
        Assertion::regex($total, '/\-?[0-9 ]+,[0-9]+/');

        $this->operationDate = $operationDate;
        $this->postingDate   = $postingDate;
        $this->description   = $description;
        $this->title         = $title;
        $this->payee         = $payee;
        $this->accountNumber = $accountNumber;
        $this->amount        = $amount;
        $this->total         = $total;
    }

    public static function fromArray(array $data) : self
    {
        Assertion::count($data, self::TOTAL_COLUMNS);

        return new self(...$data);
    }

    public function operationDate() : DateTimeInterface
    {
        return new DateTime($this->operationDate);
    }

    public function title() : string
    {
        return $this->convertTitleCharacters($this->title);
    }

    public function amount() : float
    {
        return (float) str_replace([',', ' '], ['.', ''], $this->amount);
    }

    /**
     * @TODO Find a better way. This is a first Google Search approach as it is not a key feature.
     */
    private function convertTitleCharacters(string $value) : string
    {
        $mBankSickCharacters = [
            chr(0xB1),
            chr(0xE6),
            chr(0xEA),
            chr(0xB3),
            chr(0xF1),
            chr(0xF3),
            chr(0xB6),
            chr(0xBC),
            chr(0xBF),
            chr(0xA1),
            chr(0xC6),
            chr(0xCA),
            chr(0xA3),
            chr(0xD1),
            chr(0xD3),
            chr(0xA6),
            chr(0xAC),
            chr(0xAF),
        ];

        $polishNiceCharacters = [
            'ą',
            'ć',
            'ę',
            'ł',
            'ń',
            'ó',
            'ś',
            'ź',
            'ż',
            'Ą',
            'Ć',
            'Ę',
            'Ł',
            'Ń',
            'Ó',
            'Ś',
            'Ź',
            'Ż',
        ];

        return str_replace($mBankSickCharacters, $polishNiceCharacters, $value);
    }
}
