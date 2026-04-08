<?php

if (!function_exists('isTestMode')) {
    function isTestMode() {
        return true;
    }
}

if (!function_exists('isConnected')) {
    function isConnected() {
        return false;
    }
}

if (!function_exists('verifyUrl')) {
    function verifyUrl($url = '') {
        return 'http://127.0.0.1';
    }
}

if (!function_exists('app_url')) {
    function app_url() {
        return url('/');
    }
}

if (!function_exists('gv')) {
    function gv($array, $key, $default = null) {
        return $array[$key] ?? $default;
    }
}

if (!function_exists('gbv')) {
    function gbv($array, $key) {
        return $array[$key] ?? 0;
    }
}
