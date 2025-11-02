<?php
session_start();

// Default language
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en'; // Default to English
}

// Handle language switching
if (isset($_GET['lang']) && in_array($_GET['lang'], ['fa', 'en', 'it'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// Current language
$current_lang = $_SESSION['lang'];

// Load translations
function loadTranslations($lang) {
    $translations = [];
    $langFile = __DIR__ . '/languages/' . $lang . '.php';
    if (file_exists($langFile)) {
        include $langFile;
    }
    return $translations;
}

$translations = loadTranslations($current_lang);

// Translation function
function t($key, $default = '') {
    global $translations;
    return isset($translations[$key]) ? $translations[$key] : ($default ?: $key);
}

// Base URL
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']);
?>

