<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Model\YNAB;

use DateTime;
use DateTimeInterface;
use Money\Money;
use RadnoK\YNABTranslator\Exception\TransactionCannotBeNegative;
use RadnoK\YNABTranslator\Exception\TransactionCannotBeZero;
use RadnoK\YNABTranslator\Exception\TransactionCannotHaveMultipleOperations;

final class Transaction
{
    /** @var DateTime */
    private $date;

    /** @var string|null */
    private $payee;

    /** @var string|null */
    private $memo;

    /** @var string|null */
    private $inflow;

    /** @var string|null */
    private $outflow;

    public function __construct(
        DateTimeInterface $date,
        ?string $payee,
        ?string $memo,
        ?Money $inflow = null,
        ?Money $outflow = null
    ) {
        $this->validateTransaction($inflow, $outflow);

        $this->date    = $date;
        $this->payee   = $payee;
        $this->memo    = $memo;
        $this->inflow  = $inflow;
        $this->outflow = $outflow;
    }

    public function date() : DateTimeInterface
    {
        return $this->date;
    }

    public function payee() : ?string
    {
        return $this->payee;
    }

    public function memo() : ?string
    {
        return $this->memo;
    }

    public function inflowAmount() : ?float
    {
        if ($this->inflow === null) {
            return null;
        }

        return (float) $this->inflow->getAmount();
    }

    public function outflowAmount() : ?float
    {
        if ($this->outflow === null) {
            return null;
        }

        return (float) $this->outflow->getAmount();
    }

    public function toArray() : array
    {
        return [
            'date' => $this->date()->format('Y-m-d'),
            'payee' => $this->payee(),
            'memo' => $this->memo(),
            'inflow' => $this->inflowAmount(),
            'outflow' => $this->outflowAmount(),
        ];
    }

    private function validateTransaction(?Money $inflow, ?Money $outflow) : void
    {
        if ($inflow === null && $outflow === null) {
            throw new TransactionCannotBeZero();
        }

        if ($inflow instanceof Money && $outflow instanceof Money) {
            throw new TransactionCannotHaveMultipleOperations();
        }

        if (($inflow instanceof Money && $inflow->isNegative()) || ($outflow instanceof Money && $outflow->isNegative())) {
            throw new TransactionCannotBeNegative();
        }
    }
}
