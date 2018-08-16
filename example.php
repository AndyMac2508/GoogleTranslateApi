<?php
require_once 'vendor/autoload.php';

use AndyMac\GoogleTranslator\Objects\GoogleTranslator;
use AndyMac\GoogleTranslator\Objects\JapanTranslate;

$translator = new GoogleTranslator("AIzaSyDW9brX189036CgRXhXK-gfpE1WGqvmKWg");

$language = $translator->detectLanguage("Hallo hell how are you Schönen Tag");

var_dump($language);













?>

