<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Exception;

use RuntimeException;

final class TransactionCannotHaveMultipleOperations extends RuntimeException
{
    protected $message = 'Transaction cannot have multiple operations.';
}
