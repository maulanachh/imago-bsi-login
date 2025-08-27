<?php

if (!function_exists('format_rupiah')) {
    function format_rupiah($nominal)
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }
}

if (!function_exists('unformat_rupiah')) {
    function unformat_rupiah($nominal)
    {
        return (int) preg_replace('/[^0-9]/', '', $nominal);
    }
}
