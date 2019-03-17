<?php

declare(strict_types=1);

namespace RadnoK\YNABTranslator\Parser\MBank;

use RadnoK\YNABTranslator\Model\MBank;

final class MemoParser implements MemoParserInterface
{
    public function parse(MBank\Transaction $transaction): string
    {
        $title = $transaction->title();

        \preg_match("/\/[A-Za-z0-9](.*)DATA TRANSAKCJI: [0-9]{4}-[0-9]{2}-[0-9]{2}/", $title, $matches);

        if (0 === \count($matches)) {
            return \ucfirst(\strtolower($title));
        }

        return \ucfirst(\strtolower(\str_replace($matches[0], '', $title)));
    }
}
