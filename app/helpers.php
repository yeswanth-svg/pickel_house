<?php


use Carbon\Carbon;

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






