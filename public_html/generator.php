<?php

use PrintableCards\Service\PdfCardsService;

define('FPDF_FONTPATH','/home/v/printable-cards/fonts');

require_once(__DIR__ . '/../vendor/autoload.php');

$data = [];
for ($i = $_GET['start']; $i < $_GET['end']; $i++) {
    $data[] = sprintf('%s%03d', $_GET['id'], $i);
}

$pdfCards = new PdfCardsService(new FPDF, [
    'font_custom_ttf' => $_GET['font'],
    'font_size' => $_GET['size']
]);
$pdfCards->getPrintableCards($data, $_GET['columns'], $_GET['rows']);
