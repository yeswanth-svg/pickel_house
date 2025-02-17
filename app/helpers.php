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
        // Check if a currency is selected in the session (from the dropdown)
        $selectedCurrency = session('selected_currency');

        // If no currency is selected in the session, use the logged-in user's country as fallback
        if (!$selectedCurrency) {
            $userCountry = auth()->user()->country ?? 'INR'; // Default to INR if no user country is found
            $selectedCurrency = $userCountry;
        }

        // Define currency mapping
        $currencyMap = [
            'INR' => 'INR',
            'USD' => 'USD',
            'CAD' => 'CAD',
            'AUD' => 'AUD',
            'GBP' => 'GBP', // Add more if needed
        ];

        // Ensure selected currency is valid
        $toCurrency = $currencyMap[$selectedCurrency] ?? 'INR'; // Default to INR if not found

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


if (!function_exists('PaymentPrice')) {
    function PaymentPrice($amount, $numericOnly = false)
    {
        $user = auth()->user();
        // Use the user's country currency if logged in; otherwise, use session
        $country = $user ? $user->country : 'INR';

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

function getOrderStageColor($stage)
{
    return [
        'confirmed' => 'primary',
        'processing' => 'info',
        'shipped' => 'warning',
        'delivered' => 'success',
        'completed' => 'success',
        'cancelled' => 'danger',
    ][$stage] ?? 'secondary';
}

function getPaymentStateColor($state)
{
    return [
        'pending' => 'warning',
        'processing' => 'info',
        'failed' => 'danger',
        'completed' => 'success',
    ][$state] ?? 'secondary';
}










