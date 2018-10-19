<?php

namespace PrintableCards\Service;

use FPDF;

class PdfCardsService implements PrintableCardsServiceInterface
{
    protected $fpdf;
    protected $pageWidth;
    protected $pageHeight;

    public function __construct(FPDF $fpdf, array $options = [])
    {
        $this->fpdf = $fpdf;
        $this->pageWidth = $fpdf->getPageWidth();
        $this->pageHeight = $fpdf->getPageHeight();

        $this->fpdf->SetFont(
            $options['font_family'] ?? 'Arial',
            $options['font_style'] ?? 'B',
            $options['font_size'] ?? 30
        );
        $this->fpdf->SetMargins(0, 0);
        $this->fpdf->SetAutoPageBreak(false);
    }

    public function getPrintableCards(array $data, int $columns, int $rows)
    {
        $rowHeight = $this->pageHeight / $rows;
        $columnWidth = $this->pageWidth / $columns;

        $currentColumn = 1;
        $currentRow = 1;

        $this->fpdf->AddPage();
        $this->fpdf->Ln($rowHeight / 2);

        foreach ($data as $text) {
            $this->fpdf->Cell($columnWidth, 0, $text, null, null, 'C');

            $currentColumn++;
            if ($currentColumn > $columns) {
                $this->fpdf->Ln($rowHeight);

                $currentRow++;
                $currentColumn = 1;
            }

            if ($currentRow > $rows) {
                $this->fpdf->AddPage();
                $this->fpdf->Ln($rowHeight / 2);

                $currentRow = 1;
            }
        }

        $this->fpdf->Output();
    }
}
