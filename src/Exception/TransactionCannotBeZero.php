<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Exception;

final class TransactionCannotBeZero extends \RuntimeException
{
    protected $message = 'Transaction cannot be Zero.';
}
