<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Model\YNAB;

use function array_map;
use function count;

final class Transactions
{
    /** @var Transaction[] */
    private $transactions;

    public function __construct(Transaction ...$transactions)
    {
        $this->transactions = $transactions;
    }

    public function count() : int
    {
        return count($this->transactions);
    }

    public function all() : array
    {
        return array_map(
            static function (Transaction $transaction) : array {
                return $transaction->toArray();
            },
            $this->transactions
        );
    }
}
