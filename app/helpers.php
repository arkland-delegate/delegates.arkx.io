<?php

use Illuminate\Support\Carbon;

function format_number($value, int $decimals = 8)
{
    return number_format($value, $decimals);
}

function format_arktoshi(int $value, int $decimals = 8)
{
    return number_format($value / ARKTOSHI, $decimals);
}

function humanize_epoch(int $value)
{
    return Carbon::parse('2017-03-21T13:00:00.000Z')->addSeconds($value);
}

function parsedown(string $value)
{
    return (new Parsedown())->text(htmlspecialchars($value));
}
