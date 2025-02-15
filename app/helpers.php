<?php


use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Cache;

if (!function_exists('formatCurrency')) {
    function formatCurrency($amount)
    {
        $formatter = new \NumberFormatter('en_IN', \NumberFormatter::DECIMAL);
        return '₹ ' . $formatter->format($amount);
    }
}


function convertToWords($amount)
{
    $formatter = new \NumberFormatter('en_IN', \NumberFormatter::SPELLOUT);
    return ucfirst($formatter->format($amount) . ' Rupees Only');
}

function formatDate($date)
{
    return Carbon::parse($date)->format('d-m-Y');
}




if (!function_exists('convertPrice')) {
    function convertPrice($amount, $numericOnly = false)
    {
        $user = auth()->user();
        // Use the user's country currency if logged in; otherwise, use session
        $country = $user ? $user->country : session('selected_currency', 'INR');

        // Define currency mapping
        $currencyMap = [
            'INR' => 'INR',
            'USD' => 'USD',
            'CAD' => 'CAD',
            'AUD' => 'AUD',
            'GBP' => 'GBP', // Add more if needed
        ];

        // Ensure selected currency is valid
        $toCurrency = $currencyMap[$country] ?? 'INR';

        // Fetch conversion rate with caching
        $conversionRate = getExchangeRate('INR', $toCurrency);

        // Convert the price
        $convertedAmount = $amount * $conversionRate;

        // Return numeric value if requested
        if ($numericOnly) {
            return round($convertedAmount, 2);
        }

        // Format and return price with currency symbol
        return getCurrencySymbol($toCurrency) . number_format($convertedAmount, 2);
    }
}




if (!function_exists('getExchangeRate')) {
    function getExchangeRate($from, $to)
    {
        $cacheKey = "exchange_rate_{$from}_{$to}";

        return Cache::remember($cacheKey, now()->addHours(12), function () use ($from, $to) {
            try {
                // Alternative API
                $response = Http::get("https://open.er-api.com/v6/latest/{$from}");

                if ($response->successful()) {
                    $rates = $response->json()['rates'] ?? [];
                    return $rates[$to] ?? 1;
                }
            } catch (\Exception $e) {
                \Log::error("Exchange rate API failed: " . $e->getMessage());
                return 1; // Default rate if API fails
            }

            return 1;
        });
    }
}


if (!function_exists('getCurrencySymbol')) {
    function getCurrencySymbol($currency)
    {
        $symbols = [
            'GBP' => '£  ',
            'USD' => '$  ',
            'AUD' => 'A$  ',
            'CAD' => 'C$  ',
        ];

        return $symbols[$currency] ?? '₹';
    }
}









