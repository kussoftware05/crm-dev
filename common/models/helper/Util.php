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

    /**
     * calculate persentage between two values
     * 
     * @param int $original
     * @param int $acctual
     * @return int
     */
    public static function calculatePersentage($original, $acctual)
    {
        if(!\is_int($original))
            $original = (int) $original;
        
        if(!is_int($acctual))
            $acctual = (int) $acctual;

        return (($original - $acctual)/$original) * 100;
    }
}