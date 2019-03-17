<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Exception;

use RuntimeException;

final class TransactionCannotBeZero extends RuntimeException
{
    protected $message = 'Transaction cannot be Zero.';
}
