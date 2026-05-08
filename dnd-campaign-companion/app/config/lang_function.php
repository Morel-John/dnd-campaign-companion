<?php
session_start();

## Whitelist: Which language are allowed 
$allowed_langs = ['de', 'en'];

## Default language
$default_lang = $_ENV['APP_LANG'] ?? 'en';

## If change-language-button is clicked
if (isset($_GET['lang']) && in_array($_GET['lang'], $allowed_langs)) {
    $_SESSION['lang'] = $_GET['lang'];
}

## Fallback: If session is manipulated or empty 
$current_lang = (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $allowed_langs))
    ? $_SESSION['lang']
    : $default_lang;

## Save loading of file
$lang_file =  __DIR__ . "/lang/" . $current_lang . ".php"; ## __DIR__ = directory of the file

if (file_exists($lang_file)) {
    $lang_strings = require $lang_file;
} else {
    ## Absolute emergency-fallback
    $lang_strings = require __DIR__ . "/lang/de.php";
}

## Function to translate Text based on selection
function t($key)
{
    global $lang_strings;
    return isset($lang_strings[$key]) ? $lang_strings[$key] : $key;
}
