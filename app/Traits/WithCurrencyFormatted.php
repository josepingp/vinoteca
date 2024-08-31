<?php

namespace App\Traits;
use NumberFormatter;

trait WithCurrencyFormatted
{
    public function formatCurrency($value): string
    {
        $formatter = new NumberFormatter('es_ES', NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($value, 'EUR');
    }
}
