<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Exchange rates relative to the base currency (NGN).
     * 1 USD = 1500 NGN
     * 1 EUR = 1600 NGN
     */
    public static $rates = [
        'NGN' => 1,
        'USD' => 1500,
        'EUR' => 1600,
    ];

    public static $symbols = [
        'NGN' => '₦',
        'USD' => '$',
        'EUR' => '€',
    ];

    public static function formatPrice($priceInNaira)
    {
        $currency = session('currency', 'NGN');
        
        // Fallback to NGN if invalid
        if (!array_key_exists($currency, self::$rates)) {
            $currency = 'NGN';
        }

        $rate = self::$rates[$currency];
        $convertedPrice = $priceInNaira / $rate;

        $symbol = self::$symbols[$currency];

        return $symbol . number_format($convertedPrice, 2);
    }

    public static function getCurrentCurrency()
    {
        return session('currency', 'NGN');
    }
}
