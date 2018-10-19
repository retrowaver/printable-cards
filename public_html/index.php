<?php

use PrintableCards\Service\PdfCardsService;
use FPDF;

define('FPDF_FONTPATH','/home/v/printable-cards/fonts');

require_once(__DIR__ . '/../vendor/autoload.php');

$data = [];
for ($i = 1; $i < 30; $i++) {
    $data[] = sprintf('XX%03d', $i);
}

$pdfCards = new PdfCardsService(new FPDF, ['font_custom_ttf' => 'KGDoYouLoveMe']);
$pdfCards->getPrintableCards($data, 3, 8);
