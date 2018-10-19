<?php

namespace PrintableCards\Service;

interface PrintableCardsServiceInterface
{
    public function getPrintableCards(array $data, int $columns, int $rows);
}
