<?php
require_once 'vendor/autoload.php';

use AndyMac\GoogleTranslator\Objects\GoogleTranslator;
use AndyMac\GoogleTranslator\Objects\JapanTranslate;

$translator = new GoogleTranslator("[API KEY]");


$translator->setTranslateLang('de');

$translated = $translator->translate("heelo my name is andrew");

var_dump($translated);


$language = $translator->detectLanguage("Hallo hell how are you Schönen Tag");

var_dump($language);













?>

