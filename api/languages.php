<?php
/**
 * This API endpoint is no longer needed since translations are inline in JavaScript.
 * Keeping this file for backward compatibility, but it returns empty translations.
 * The frontend (index.html) uses inline translations from assets/js/i18n.js
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

$lang = isset($_GET['lang']) ? trim($_GET['lang']) : 'en';

// Validate language
if (!in_array($lang, ['en', 'fa', 'it'])) {
    $lang = 'en';
}

// Note: Translations are now inline in JavaScript (assets/js/i18n.js)
// This API is kept for backward compatibility
$translations = [];

// Return empty translations - frontend will use inline translations
echo json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>

