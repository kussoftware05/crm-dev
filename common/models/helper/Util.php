<?php

namespace common\models\helper;

class Util
{
    /**
     * @param string $locale
     * @param string $currency_code
     * @return string
     */
    public static function getPriceWithCurrency($value, $locale='en_US', $currency_code='USD')
    {
        $format = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        return $format->formatCurrency($value, $currency_code);
    }
}